<?php 
    require_once('sparqlib.php');
    function query($category) {
        $db = sparql_connect("/sample/query?force-accept=text%2Fplain");
        if (!$db) {
            print sparql_errno() .": ". sparql_errno(). "\n"; exit;
        }
        sparql_ns("foo", "https://semanticresto.com/");
        sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
        sparql_ns("foaf", "http://xmlns.com/foaf/0.1/");
        $sparql = "
        prefix foo: <https://semanticresto.com/> 
        prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
        prefix foaf: <http://xmlns.com/foaf/0.1/>
        select ?name ?price ?ingredients ?category ?url
        where{ 
        ?food foaf:name ?name .
        ?food foaf:price ?price .
        ?food foaf:ingredients ?ingredients .
        ?food foaf:category ?category .
        ?food foaf:url ?url .
        filter (?category = '".$category."')
        }";

        $result = sparql_query($sparql);
        return $result;
    }
    var_dump(query("Breakfast"));
    function query1() {
        $db = sparql_connect("http://localhost:3030/book/sparql");
        if (!$db) {
            print sparql_errno() .": ". sparql_errno(). "\n"; exit;
        }

        $sparql = "
        prefix lib: <http://perpus.com/> 
        prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
        prefix dc: <http://dublincore.org/documents/dces/>
        select ?authors ?release ?title ?url
        where{ 
        ?book dc:authors ?authors .
        ?book dc:releaseDate ?release .
        ?book dc:title ?title .
        ?book dc:url ?url .
        
        }";

        $result = sparql_query($sparql);
        return $result;
    }
?>
