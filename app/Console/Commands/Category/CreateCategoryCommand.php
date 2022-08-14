<?php

namespace App\Console\Commands\Category;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class CreateCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Category Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [];

        // read input data
        $data['name']       = $this->ask('Please enter a name for your Category');
        $data['parent_id']  = $this->ask('In case you want the attach a parent category, please enter the Id of the parent');

        // create category
        try {
            resolve(CategoryService::class)->create($data);

            $this->info('Category created successfully !!');

        } catch (\Throwable $th) {
            $this->line('Category creation faild !!', 'bg=red');
            $this->line('Please check your data again.');
        }
    }
}
