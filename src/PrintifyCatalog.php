<?php

namespace Printify;
use Printify\Structures\Catalog\Blueprint;
use Printify\Structures\Catalog\PrintProvider;
use Printify\Structures\Catalog\Shipping;
use Printify\Structures\Catalog\Variant;

class PrintifyCatalog extends PrintifyBaseEndpoint
{
    protected $_structure = Blueprint::class;

    public function all(array $query_options = []): array
    {
        $items = $this->_api_client->doRequest('catalog/blueprints.json');
        return $this->collectStructure($items);
    }

    /**
     * Retrieve a specific blueprint
     *
     * @param int $id
     * @return Blueprint
     */
    public function find($id): Blueprint
    {
        $item = $this->_api_client->doRequest('catalog/blueprints/'.$id.'.json');
        return new Blueprint($item);
    }

    /**
     * Retrieve a list of all print providers that fulfill orders for a specific blueprint
     *
     * @param int $blueprint_id
     * @return array
     */
    public function print_providers($blueprint_id): array
    {
        $items = $this->_api_client->doRequest('catalog/blueprints/'.$blueprint_id.'/print_providers.json');
        return $this->collectStructure($items, PrintProvider::class);
    }

    /**
     * Retrieve a list of all variants of a blueprint from a specific print provider
     *
     * @param int $blueprint_id
     * @param int $print_provider_id
     * @return array
     */
    public function print_provider_variants($blueprint_id, $print_provider_id): array
    {
        $items = $this->_api_client->doRequest('catalog/blueprints/'.$blueprint_id.'/print_providers/'.$print_provider_id.'/variants.json');
        return $this->collectStructure($items, Variant::class);
    }

    /**
     * Retrieve the shipping information for all variants of a blueprint from a specific print provider
     *
     * @param int $blueprint_id
     * @param int $print_provider_id
     * @return void
     */
    public function print_provider_shipping($blueprint_id, $print_provider_id)
    {
        $items = $this->_api_client->doRequest('catalog/blueprints/'.$blueprint_id.'/print_providers/'.$print_provider_id.'/shipping.json');
        return $this->collectStructure($items, Shipping::class);
    }

    /**
     * Retrieve a list of all available print-providers
     *
     * @return array
     */
    public function all_print_providers(): array
    {
        $items = $this->_api_client->doRequest('catalog/print_providers.json');
        return $this->collectStructure($items, PrintProvider::class);
    }

    /**
     * Retrieve a specific print-provider and a list of associated blueprint offerings
     *
     * @param int $id
     * @return PrintProvider
     */
    public function print_provider($id): PrintProvider
    {
        $item = $this->_api_client->doRequest('catalog/print_providers/'.$id.'.json');
        return new PrintProvider($item);
    }
}
