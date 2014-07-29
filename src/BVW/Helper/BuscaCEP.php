<?php
require_once(__DIR__."/../../../vendor/phpQuery/phpQuery/phpQuery.php");

class BuscaCEP
{
    CONST URL = "http://m.correios.com.br/movel/buscaCepConfirma.do";
    
    public static function busca($cep)
    {
        $html = self::simple_curl(self::URL, array(
                'cepEntrada'=>$cep,
                'tipoCep'=>'',
                'cepTemp'=>'',
                'metodo'=>'buscarCep'
        ));
        
        phpQuery::newDocumentHTML($html, $charset = 'utf-8');

        $dados = array(
            'Logradouro'=> trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html()),
            'Bairro'=> trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html()),
            'Cidade/uf'=> trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html()),
            'Cep'=> trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html())
        );

        $dados['Cidade/uf'] = explode('/',$dados['Cidade/uf']);
        $dados['Cidade'] = trim($dados['Cidade/uf'][0]);
        $dados['UF'] = isset($dados['Cidade/uf'][1]) ? trim($dados['Cidade/uf'][1]) : null;
        unset($dados['Cidade/uf']);
        
        return $dados;
    }
    
    private static function simple_curl($url,$post=array(),$get=array())
    {
	$url = explode('?',$url,2);
	// return $url;
	if(count($url)===2){
		$temp_get = array();
		parse_str($url[1],$temp_get);
		$get = array_merge($get,$temp_get);
	}

	$ch = 
		curl_init($url[0]."?".http_build_query($get));
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec ($ch);
    }
}