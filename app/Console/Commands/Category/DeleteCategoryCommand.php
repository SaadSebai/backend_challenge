<?php

namespace App\Console\Commands\Category;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class DeleteCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {id : Id of a Category }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a Category Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categoryService = new CategoryService();

        // read input data
        $categoryId = $this->argument('id');

        if (!$this->confirm('Are you sure you want to delete this Category (Y/N)?', false)) {
            return;
        }

        // find and delete category
        try {

            if(!$category = $categoryService->getById($categoryId))
            {
                $this->line('This Category does not exist !!', 'bg=yellow');
                return;
            }

            $categoryService->delete($category);

            $this->info('Category deleted successfully !!');

        } catch (\Throwable $th) {
            $this->line('Category deletion faild !!', 'bg=red');
            $this->line($th);
        }
    }
}
