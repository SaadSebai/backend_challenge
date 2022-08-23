<?php

namespace App\Console\Commands\Product;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
     * @param  ProductService $productService
     *
     * @return int
     */
    public function handle(ProductService $productService)
    {
        // read input data
        $productId = $this->argument('id');

        if (!$this->confirm('Are you sure you want to delete this Product (Y/N)?', false)) {
            return;
        }

        // find and delete product
        try {
            if($this->validation(id: $productId)) return;

            $productService->delete(Product::find($productId));

            $this->info('Product deleted successfully !!');

        } catch (\Throwable $th) {
            $this->line('Product deletion faild !!', 'bg=red');
            $this->line($th);
        }
    }

    /**
     * Validate Console input data,
     * Returns true if data is invald
     *
     * @param  mixed $id
     *
     * @return bool
     */
    private function validation($id): bool
    {
        $validator = Validator::make([
            'id' => $id
        ], [
            'id' => ['required', 'bail', 'integer', Rule::exists('products', 'id')]
        ]);

        if ($validator->fails()) {
            $this->info('Failed to delete Product:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return true;
        }

        return false;
    }
}
