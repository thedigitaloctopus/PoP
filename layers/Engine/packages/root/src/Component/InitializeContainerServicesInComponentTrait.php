<?php

declare(strict_types=1);

namespace PoP\Root\Component;

use PoP\Root\Container\ContainerBuilderFactory;
use PoP\Root\Container\Loader\ForceAutoconfigureYamlFileLoader;
use PoP\Root\Container\SystemContainerBuilderFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

trait InitializeContainerServicesInComponentTrait
{
    /**
     * Initialize the services defined in the YAML configuration file.
     * If not provided, use "services.yaml"
     *
     * @param string $componentDir
     * @param string $configPath
     * @param string $fileName
     * @return void
     */
    public static function initYAMLServices(
        string $componentDir,
        string $configPath = '',
        string $fileName = 'services.yaml'
    ): void {
        // First check if the container has been cached. If so, do nothing
        if (!ContainerBuilderFactory::isCached()) {
            // Initialize the ContainerBuilder with this component's service implementations
            /** @var ContainerBuilder */
            $containerBuilder = ContainerBuilderFactory::getInstance();
            self::loadServicesFromYAMLConfigIntoContainer($containerBuilder, $componentDir, $configPath, $fileName);
        }
    }

    /**
     * Initialize the services defined in the YAML configuration file.
     * If not provided, use "services.yaml"
     *
     * @param string $componentDir
     * @param string $configPath
     * @param string $fileName
     * @return void
     */
    protected static function loadServicesFromYAMLConfigIntoContainer(
        ContainerBuilder $containerBuilder,
        string $componentDir,
        string $configPath,
        string $fileName
    ): void {
        $componentPath = self::getComponentPath($componentDir, $configPath);
        $loader = new YamlFileLoader($containerBuilder, new FileLocator($componentPath));
        $loader->load($fileName);
    }

    /**
     * Initialize the services defined in the YAML configuration file.
     * If not provided, use "services.yaml"
     *
     * @param string $componentDir
     * @param string $configPath
     * @param string $fileName
     * @return void
     */
    protected static function getComponentPath(
        string $componentDir,
        string $configPath = ''
    ): string {
        return $componentDir . '/config' . ($configPath ? '/' . trim($configPath, '/') : '');
    }

    /**
     * Initialize the services defined in the PHP configuration file.
     * If not provided, use "services.yaml"
     *
     * @param string $componentDir
     * @param string $configPath
     * @param string $fileName
     * @return void
     */
    public static function initPHPServices(
        string $componentDir,
        string $configPath = '',
        string $fileName = 'services.php'
    ): void {
        // First check if the container has been cached. If so, do nothing
        if (!ContainerBuilderFactory::isCached()) {
            // Initialize the ContainerBuilder with this component's service implementations
            /** @var ContainerBuilder */
            $containerBuilder = ContainerBuilderFactory::getInstance();
            $componentPath = self::getComponentPath($componentDir, $configPath);
            $loader = new PhpFileLoader($containerBuilder, new FileLocator($componentPath));
            $loader->load($fileName);
        }
    }

    /**
     * If param `$skipSchema` is `true`, define the schema services
     * in the container, but do not initialize them.
     * If file name provided, use "schema-services.yaml"
     */
    public static function maybeInitYAMLSchemaServices(
        string $componentDir,
        bool $skipSchema,
        string $configPath = '',
        string $fileName = 'schema-services.yaml'
    ): void {
        if (!ContainerBuilderFactory::isCached()) {
            /** @var ContainerBuilder */
            $containerBuilder = ContainerBuilderFactory::getInstance();
            $componentPath = self::getComponentPath($componentDir, $configPath);
            $autoconfigure = !$skipSchema;
            $loader = new ForceAutoconfigureYamlFileLoader(
                $containerBuilder,
                new FileLocator($componentPath),
                $autoconfigure
            );
            $loader->load($fileName);
        }
    }

    /**
     * Load services into the System Container
     *
     * @param string $componentDir
     * @param string $configPath
     * @param string $fileName
     * @return void
     */
    public static function initYAMLSystemContainerServices(
        string $componentDir,
        string $configPath = '',
        string $fileName = 'system-services.yaml'
    ): void {
        // First check if the container has been cached. If so, do nothing
        if (!SystemContainerBuilderFactory::isCached()) {
            // Initialize the ContainerBuilder with this component's service implementations
            /** @var ContainerBuilder */
            $containerBuilder = SystemContainerBuilderFactory::getInstance();
            self::loadServicesFromYAMLConfigIntoContainer($containerBuilder, $componentDir, $configPath, $fileName);
        }
    }

    /**
     * If param `$skipSchema` is `true`, initialize the schema services defined in the YAML configuration file.
     * If not provided, use "schema-services.yaml"
     *
     * @param string $componentDir
     * @param boolean $skipSchema
     * @param string $configPath
     * @param string $fileName
     * @return void
     */
    public static function maybeInitPHPSchemaServices(
        string $componentDir,
        bool $skipSchema,
        string $configPath = '',
        string $fileName = 'schema-services.php'
    ): void {
        if ($skipSchema) {
            return;
        }
        self::initPHPServices($componentDir, $configPath, $fileName);
    }
}
