<?php

namespace App\Console\Commands\Category;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
     * @param  CategoryService $categoryService
     *
     * @return int
     */
    public function handle(CategoryService $categoryService)
    {
        // read input data
        $categoryId = $this->argument('id');

        if (!$this->confirm('Are you sure you want to delete this Category (Y/N)?', false)) {
            return;
        }

        // find and delete category
        try {
            if($this->validation(id: $categoryId)) return;

            $categoryService->delete(Category::find($categoryId));

            $this->info('Category deleted successfully !!');

        } catch (\Throwable $th) {
            $this->line('Category deletion faild !!', 'bg=red');
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
            'id' => ['required', 'bail', 'integer', Rule::exists('categories', 'id')]
        ]);

        if ($validator->fails()) {
            $this->info('Failed to delete Category:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return true;
        }

        return false;
    }
}
