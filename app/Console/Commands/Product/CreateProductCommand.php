<?php

namespace App\Console\Commands\Product;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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
     * @return int
     */
    public function handle()
    {
        $data = [];

        // read input data
        $data['name']           = $this->ask('Please enter a name for your Product');
        $data['description']    = $this->ask('Please enter a description for your Product');
        $data['price']          = $this->ask('Please enter a price for your Product');
        $data['image']          = $this->ask('Please enter a image for your Product');
        $data['category_id']    = $this->ask('Please enter the ID of a Category for your Product');

        // create product
        try {
            if(!$this->isValidData($data)) return;

            resolve(ProductService::class)->create($data);

            $this->info('Product created successfully !!');

        } catch (\Throwable $th) {
            $this->line('Product creation faild !!', 'bg=red');
            $this->line('Please check your data again.');
        }
    }

    /**
     * Validate console data
     *
     * @param  array $data
     *
     * @return bool
     */
    private function isValidData(array $data): bool
    {
        if(!in_array(File::extension($data['image']), self::IMAGE_EXTENSIONS))
        {
            $this->line('Invalid image extention !!', 'bg=yellow');
            return false;
        }

        if(!resolve(CategoryService::class)->getById($data['category_id']))
        {
            $this->line('This Category does not exist !!', 'bg=yellow');
            return false;
        }

        return true;
    }
}
