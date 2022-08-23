<?php

namespace App\Console\Commands\Category;

use App\Services\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
     * @param  CategoryService $categoryService
     *
     * @return int
     */
    public function handle(CategoryService $categoryService)
    {
        // read input data
        $name       = $this->ask('Please enter a name for your Category');
        $parent_id  = $this->ask('In case you want the attach a parent category, please enter the Id of the parent');

        // create category
        try {
            if($this->validation(name: $name, parent_id: $parent_id)) return;

            $categoryService->create(name: $name, parent_id: $parent_id);

            $this->info('Category created successfully !!');

        } catch (\Throwable $th) {
            $this->line('Category creation faild !!', 'bg=red');
            $this->line('Please check your data again.');
        }
    }

    /**
     * Validate Console input data,
     * Returns true if data is invald
     *
     * @param  mixed $name
     * @param  mixed $parent_id
     *
     * @return bool
     */
    private function validation($name, $parent_id): bool
    {
        $validator = Validator::make([
            'name'      => $name,
            'parent_id' => $parent_id
        ], [
            'name'      => ['required', 'string', 'max:121'],
            'parent_id' => ['nullable', 'bail', 'integer', Rule::exists('categories', 'id')]
        ]);

        if ($validator->fails()) {
            $this->info('Failed to create Category:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return true;
        }

        return false;
    }
}
