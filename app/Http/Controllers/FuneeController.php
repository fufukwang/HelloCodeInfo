<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class FuneeController extends Controller
{
    //

    public function __construct(){


    }

    public function index(Request $request){
    	


    	
    }


    public function getRssUrl(){
    	$guzzleClient = new \GuzzleHttp\Client();
		$response = $guzzleClient->get('http://rss.cnn.com/rss/edition.rss');
		$body = $response->getBody();
		return $body;
    }















    private function removeNamespaceFromXML( $xml )
	{
	    // Because I know all of the the namespaces that will possibly appear in 
	    // in the XML string I can just hard code them and check for 
	    // them to remove them
	    $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
	    // This is part of a regex I will use to remove the namespace declaration from string
	    $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

	    // Cycle through each namespace and remove it from the XML string
	   foreach( $toRemove as $remove ) {
	        // First remove the namespace from the opening of the tag
	        $xml = str_replace('<' . $remove . ':', '<', $xml);
	        // Now remove the namespace from the closing of the tag
	        $xml = str_replace('</' . $remove . ':', '</', $xml);
	        // This XML uses the name space with CommentText, so remove that too
	        $xml = str_replace($remove . ':commentText', 'commentText', $xml);
	        // Complete the pattern for RegEx to remove this namespace declaration
	        $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
	        // Remove the actual namespace declaration using the Pattern
	        $xml = preg_replace($pattern, '', $xml, 1);
	    }

	    // Return sanitized and cleaned up XML with no namespaces
	    return $xml;
	}
}
