<?php

namespace App\Domain\IntegrationContracts\XmlToJson;

class XmlToJson implements IXmlToJson
{

    /**
     * @inheritDoc
     */
    public function xmlToArray($xml, array $options = []): array
    {
        $defaults = [
            'namespaceSeparator' => ':',
            'attributePrefix' => '@attributes',
            'alwaysArray' => [],
            'autoArray' => true,
            'textContent' => '@value',
            'autoText' => true,
            'keySearch' => false,
            'keyReplace' => false,
        ];
        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null;
        $attributes_array = [];
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attribute_name => $attribute) {
                if ($options['keySearch']) {
                    $attribute_name = str_replace($options['keySearch'], $options['keyReplace'], $attribute_name);
                }
                $attribute_key = ($prefix ? $prefix . $options['namespaceSeparator'] : '') . $attribute_name;
                $arr[$attribute_key] = (string) $attribute;
            }
            if (! empty($arr)) {
                $attributes_array[$options['attributePrefix']][] = $arr;
                $arr = null;
            }
        }
        $tags_array = [];
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $child_xml) {
                $child_array = $this->xmlToArray($child_xml, $options);
                foreach ($child_array as $child_tag_name => $child_properties) {
                    if ($options['keySearch']) {
                        $child_tag_name = str_replace($options['keySearch'], $options['keyReplace'], $child_tag_name);
                    }
                    if ($prefix) {
                        $child_tag_name = $prefix . $options['namespaceSeparator'] . $child_tag_name;
                    }
                    if (! isset($tags_array[$child_tag_name])) {
                        $tags_array[$child_tag_name] =
                            in_array($child_tag_name, $options['alwaysArray'], true) || ! $options['autoArray']
                                ? [$child_properties] : $child_properties;
                    } elseif (
                        is_array($tags_array[$child_tag_name]) && array_keys($tags_array[$child_tag_name])
                        === range(0, count($tags_array[$child_tag_name]) - 1)
                    ) {
                        $tags_array[$child_tag_name][] = $child_properties;
                    } else {
                        $tags_array[$child_tag_name] = [$tags_array[$child_tag_name], $child_properties];
                    }
                }
            }
        }
        $text_content_array = [];
        $plain_text = trim((string) $xml);
        if ($plain_text !== '') {
            $text_content_array[$options['textContent']] = $plain_text;
        }
        $properties_array = ! $options['autoText'] || $attributes_array || $tags_array || ($plain_text === '')
            ? array_merge($attributes_array, $tags_array, $text_content_array) : $plain_text;
        return [
            $xml->getName() => $properties_array,
        ];
    }
}
