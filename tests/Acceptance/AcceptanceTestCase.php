<?php

namespace Tests\Acceptance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

abstract class AcceptanceTestCase extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected function jsonCall($method, $url, $data)
    {
        return $this->json($method, $url, $data)->response;
    }

    protected function getValidationRulesForData()
    {
        return [];
    }

    protected function assertValidationFailureResponse($response)
    {
        $this->assertStatusCode(400, $response);
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $content = $this->getContentFromJsonResponse($response);
        $this->assertNotEmpty($content->errors);
    }

    protected function getContentFromJsonResponse($response, $asArray = false)
    {
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $json = $response->getContent();

        if (empty($json)) {
            return null;
        }

        $this->assertJson($json);
        $content = json_decode($json);

        if ($asArray) {
            return json_decode($json, true);
        }

        return $content;
    }

    // protected function assertDataStructureForSingleEntity($data)
    // {
    //     $this->assertJsonStructureMatches($this->getValidationRulesForData(), $data);
    // }

    // protected function assertDataStructureForMultipleEntities($data)
    // {
    //     $rules = [];

    //     foreach ($this->getValidationRulesForData() as $name => $rule) {
    //         $rules['*.' . $name] = $rule;
    //     }

    //     $this->assertJsonStructureMatches($rules, $data);
    // }

    protected function assertStatusCode($statusCode, $response)
    {
        $this->assertEquals($statusCode, $response->getStatusCode());
    }

    protected function assertDataStructureEquals($expected, $actual)
    {
        $keys = array_keys((array) $actual);
        $intersect = array_intersect($expected, $keys);
        $this->assertEquals($expected, $intersect);
    }

    // protected function assertJsonStructureMatches($constraints, $actual)
    // {
    //     $validator = $this->makeValidator($actual, $constraints);

    //     $validator->passes();

    //     $messages = array_map(function ($messages) {
    //         return reset($messages);
    //     }, $validator->errors()->toArray());

    //     $this->assertCount(
    //         0,
    //         $messages,
    //         sprintf("Failed asserting JSON structure matches expected.\n\n%s", implode(PHP_EOL, $messages))
    //     );
    // }

    // protected function makeValidator($data, array $constraints = [])
    // {
    //     $data = $this->objectToArray($data);

    //     $validator = \Validator::make($data, $constraints);

    //     $validator->addExtension('uuid', function ($attribute, $value, $parameters, $validator) {
    //         return 1 === preg_match(sprintf('~%s~', Uuid::VALID_PATTERN), $value);
    //     });

    //     $validator->addExtension('uuid4', function ($attribute, $value, $parameters, $validator) {
    //         return 1 === preg_match(sprintf('~%s~', UuidValidationServiceProvider::UUIDv4_PATTERN), $value);
    //     });

    //     return $validator;
    // }

    protected function objectToArray($object)
    {
        if (! is_string($object)) {
            $object = json_encode($object);
        }

        return json_decode($object, true);
    }

    protected function validateAndCheckJson($response)
    {
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertJson($content = $response->getContent());

        $json = json_decode($content);

        return $json;
    }

    protected function toJson($response)
    {
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertJson($content = $response->getContent());

        $json = json_decode($content);

        $this->assertJsonSchemaResponse($json);

        return $json;
    }
}
