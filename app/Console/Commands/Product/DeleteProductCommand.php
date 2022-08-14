<?php

namespace App\Console\Commands\Product;

use App\Services\ProductService;
use Illuminate\Console\Command;

class DeleteProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {id : Id of a Product }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a Product Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $productService = new ProductService();

        // read input data
        $productId = $this->argument('id');

        if (!$this->confirm('Are you sure you want to delete this Product (Y/N)?', false)) {
            return;
        }

        // find and delete product
        try {

            if(!$product = $productService->getById($productId))
            {
                $this->line('This Product does not exist !!', 'bg=yellow');
                return;
            }

            $productService->delete($product);

            $this->info('Product deleted successfully !!');

        } catch (\Throwable $th) {
            $this->line('Product deletion faild !!', 'bg=red');
            $this->line($th);
        }
    }
}
