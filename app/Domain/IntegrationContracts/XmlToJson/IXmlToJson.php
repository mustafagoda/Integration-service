<?php

namespace App\Domain\IntegrationContracts\XmlToJson;

interface IXmlToJson
{
    /**
     * @param $xml
     * @param array $options
     * @return array
     */
    public function xmlToArray($xml, array $options = []): array;
}
