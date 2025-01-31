<?php

declare(strict_types=1);

namespace PHPUnitForGraphQLAPI\WebserverRequests;

use GraphQLByPoP\GraphQLServer\Unit\FixtureTestCaseTrait;
use RuntimeException;

abstract class AbstractPersistedQueryFixtureWebserverRequestTestCase extends AbstractEndpointWebserverRequestTestCase
{
    use FixtureTestCaseTrait;

    public function getDataSetAsString(bool $includeData = true): string
    {
        return $this->addFixtureFolderInfo(parent::getDataSetAsString($includeData));
    }

    /**
     * Retrieve all files under the "/fixture" folder
     * to retrieve the expected response bodies, as JSON.
     *
     * Additional properties (such as the params)
     * must be provided via code.
     *
     * @return array<string,array<string|array<string,mixed>>>
     */
    final protected function provideEndpointEntries(): array
    {
        $fixtureFolder = $this->getFixtureFolder();
        $bodyResponseFileNameFileInfos = $this->findFilesInDirectory(
            $fixtureFolder,
            ['*.json'],
            ['*.disabled.json']
        );

        $providerItems = [];
        foreach ($bodyResponseFileNameFileInfos as $bodyResponseFileInfo) {
            $fileName = $bodyResponseFileInfo->getFilenameWithoutExtension();
            $dataName = $fileName;
            $providerItems[$dataName] = [
                'application/json',
                $bodyResponseFileInfo->getContents(),
                $this->getEndpoint($dataName),
                $this->getParams($dataName),
                $this->getQuery($dataName),
                $this->getVariables($dataName),
                $this->getOperationName($dataName),
                $this->getEntryMethod($dataName),
            ];
        }
        return $providerItems;
    }

    protected function getEntryMethod(string $dataName): string
    {
        return $this->getMethod();
    }

    /**
     * @throws RuntimeException If the endpoint is not defined
     */
    protected function getEndpoint(string $dataName): string
    {
        throw new RuntimeException(
            sprintf(
                'The endpoint for dataName "%s" has not been defined',
                $dataName
            )
        );
    }

    /**
     * @return array<string,mixed>
     */
    protected function getParams(string $dataName): array
    {
        return [];
    }

    protected function getQuery(string $dataName): string
    {
        return '';
    }

    /**
     * @return array<string,mixed>
     */
    protected function getVariables(string $dataName): array
    {
        return [];
    }

    protected function getOperationName(string $dataName): string
    {
        return '';
    }
}
