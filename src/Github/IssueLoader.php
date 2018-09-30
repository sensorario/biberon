<?php

namespace Sensorario\Biberon\Github;

class IssueLoader
{
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function load()
    {
        $community = $this->params['community'];

        $issues = [];
        $finished = false;
        $page = 1;
        while(!$finished) {
            echo "\n > scarico pagina " . $page;
            $url = "https://api.github.com/repos/" . $community . "/eventi/issues?state=all&page=" . $page;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Me');
            $output = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($output, true);
            if ($data == json_decode('[]', true)) {
                $finished = true;
            } else {
                if (isset($data['message'])) {
                    echo "\n\n";
                    echo json_encode($data, JSON_PRETTY_PRINT);
                    echo "\n\n";
                    die;
                }
                $issues = array_merge($issues, $data);
                $page++;
            }
        }

        return $issues;
    }
}

