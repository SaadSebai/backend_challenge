<?php

namespace App\Console\Commands\Product;

use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateProductCommand extends Command
{
    private const IMAGE_EXTENSIONS = ['png', 'jpeg', 'jpg', 'gif'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Product Command';

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
        $name           = $this->ask('Please enter a name for your Product');
        $description    = $this->ask('Please enter a description for your Product');
        $price          = $this->ask('Please enter a price for your Product');
        $image          = $this->ask('Please enter a image for your Product');
        $category_id    = $this->ask('Please enter the ID of a Category for your Product');

        // create product
        try {
            if($this->validation(name: $name, description: $description, price: $price, image: $image, category_id: $category_id)) return;

            $productService->create(name: $name, description: $description, price: $price, image: $image, category_id: $category_id);

            $this->info('Product created successfully !!');

        } catch (\Throwable $th) {
            $this->line('Product creation faild !!', 'bg=red');
            $this->line('Please check your data again.');
        }
    }

    /**
     * Validate Console input data,
     * Returns true if data is invald
     *
     * @param  mixed $name
     * @param  mixed $description
     * @param  mixed $price
     * @param  mixed $image
     * @param  mixed $category_id
     *
     * @return bool
     */
    private function validation($name, $description, $price, $image, $category_id): bool
    {
        $validator = Validator::make([
            'name'          => $name,
            'description'   => $description,
            'price'         => $price,
            'image'         => $image,
            'category_id'   => $category_id
        ], [
            'name'          => ['required', 'string', 'max:121'],
            'description'   => ['required', 'string', 'max:255'],
            'price'         => ['required', 'numeric', 'max:9999999'],
            'image'         => ['required', 'string'],
            'category_id'   => ['nullable', 'bail', 'integer', Rule::exists('categories', 'id')]
        ]);

        if ($validator->fails()) {
            $this->info('Failed to create Product:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return true;
        }

        if(!in_array(File::extension($image), self::IMAGE_EXTENSIONS) || !File::exists($image))
        {
            $this->line('Invalid image !!', 'bg=yellow');
            return true;
        }

        return false;
    }
}
