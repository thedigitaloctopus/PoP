<?php

declare(strict_types=1);

namespace PHPUnitForGraphQLAPI\GraphQLAPI\WebserverRequests;

class LocalhostWebserverRequestTest extends AbstractLocalhostWebserverRequestTest
{
    public function testPersistedQuery(): void
    {
        $endpoint = 'graphql-query/latest-posts-for-mobile-app-2/';
        $response = $this->request($endpoint, ['limit' => 3], 'GET');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('content-type'));
        $expectedResponseBody = <<<JSON
            {"data":{"posts":[{"date":"2021-08-07T02:20:44+00:00","excerpt":"Welcome to WordPress. This is your first post. Edit or delete it, then start writing!","url":"http:\/\/graphql-api.lndo.site\/hello-world\/","title":"Hello world!","tags":[],"author":{"displayName":"admin","url":"http:\/\/graphql-api.lndo.site\/author\/admin\/","id":1}},{"date":"2020-12-12T04:06:52+00:00","excerpt":"Verse Block Write poetry and other literary expressions honoring all spaces and line-breaks. Table Block Row 1 Column 1 Row 1 Column 2 Row 2 Column 1 Row 2 Column 2 Row 3 Column 1 Row 3 Column 2 Separator Block Spacer Block","url":"http:\/\/graphql-api.lndo.site\/public-or-private-api-mode-for-extra-security\/","title":"Public or Private API mode, for extra security","tags":[{"name":"security"},{"name":"features"}],"author":{"displayName":"admin","url":"http:\/\/graphql-api.lndo.site\/author\/admin\/","id":1}},{"date":"2020-12-12T04:02:18+00:00","excerpt":"Text Column Block Button Block Quote Block Take up one idea, make that one idea your life. Think of it, dream of it, Live on that idea let the brain, muscles, nerves, every part of your body be full of that idea, and just leave every other idea alone. This is the way to success.&hellip; <a class=\"more-link\" href=\"http:\/\/graphql-api.lndo.site\/graphql-query\/latest-posts-for-mobile-app-2\/\">Continue reading <span class=\"screen-reader-text\">Latest posts for mobile app<\/span><\/a>","url":"http:\/\/graphql-api.lndo.site\/customize-the-schema-for-each-client\/","title":"Customize the schema for each client","tags":[{"name":"ideas"},{"name":"features"},{"name":"advanced"}],"author":{"displayName":"admin","url":"http:\/\/graphql-api.lndo.site\/author\/admin\/","id":1}}]}}
        JSON;
        $this->assertJsonStringEqualsJsonString($expectedResponseBody, $response->getBody()->__toString());
    }
}
