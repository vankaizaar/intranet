<?php

use Illuminate\Database\Seeder;

class DocumentCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            [
                'name'=>'Brand Identity',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mollis non dui non imperdiet. Maecenas id vulputate sem. Aliquam erat volutpat. In hac habitasse platea dictumst. Aliquam ac venenatis enim. Curabitur in urna sit amet justo commodo euismod quis ac magna. Duis tincidunt pretium magna, id vestibulum lorem tincidunt vel. Nulla vel metus vel dolor laoreet maximus. Fusce fermentum tortor nisl, vel pretium ligula efficitur vitae. Mauris rhoncus ante id nisi auctor, vitae tempus nibh congue. Fusce placerat erat ac aliquet rutrum. Nam felis orci, consectetur et eros id, fermentum tristique justo. Sed nisl enim, vulputate quis vulputate in, semper id dolor. Nam ullamcorper malesuada leo, et molestie eros interdum nec. Quisque elementum eleifend nunc, quis malesuada lacus malesuada sed. Etiam vehicula orci quam, ut porta metus aliquam eget.'
            ],
            [
                'name'=>'Templates',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mollis non dui non imperdiet. Maecenas id vulputate sem. Aliquam erat volutpat. In hac habitasse platea dictumst. Aliquam ac venenatis enim. Curabitur in urna sit amet justo commodo euismod quis ac magna. Duis tincidunt pretium magna, id vestibulum lorem tincidunt vel. Nulla vel metus vel dolor laoreet maximus. Fusce fermentum tortor nisl, vel pretium ligula efficitur vitae. Mauris rhoncus ante id nisi auctor, vitae tempus nibh congue. Fusce placerat erat ac aliquet rutrum. Nam felis orci, consectetur et eros id, fermentum tristique justo. Sed nisl enim, vulputate quis vulputate in, semper id dolor. Nam ullamcorper malesuada leo, et molestie eros interdum nec. Quisque elementum eleifend nunc, quis malesuada lacus malesuada sed. Etiam vehicula orci quam, ut porta metus aliquam eget.'
            ],
            [
                'name'=>'Resources',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mollis non dui non imperdiet. Maecenas id vulputate sem. Aliquam erat volutpat. In hac habitasse platea dictumst. Aliquam ac venenatis enim. Curabitur in urna sit amet justo commodo euismod quis ac magna. Duis tincidunt pretium magna, id vestibulum lorem tincidunt vel. Nulla vel metus vel dolor laoreet maximus. Fusce fermentum tortor nisl, vel pretium ligula efficitur vitae. Mauris rhoncus ante id nisi auctor, vitae tempus nibh congue. Fusce placerat erat ac aliquet rutrum. Nam felis orci, consectetur et eros id, fermentum tristique justo. Sed nisl enim, vulputate quis vulputate in, semper id dolor. Nam ullamcorper malesuada leo, et molestie eros interdum nec. Quisque elementum eleifend nunc, quis malesuada lacus malesuada sed. Etiam vehicula orci quam, ut porta metus aliquam eget.'
            ],
            [
                'name'=>'Human Resources',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mollis non dui non imperdiet. Maecenas id vulputate sem. Aliquam erat volutpat. In hac habitasse platea dictumst. Aliquam ac venenatis enim. Curabitur in urna sit amet justo commodo euismod quis ac magna. Duis tincidunt pretium magna, id vestibulum lorem tincidunt vel. Nulla vel metus vel dolor laoreet maximus. Fusce fermentum tortor nisl, vel pretium ligula efficitur vitae. Mauris rhoncus ante id nisi auctor, vitae tempus nibh congue. Fusce placerat erat ac aliquet rutrum. Nam felis orci, consectetur et eros id, fermentum tristique justo. Sed nisl enim, vulputate quis vulputate in, semper id dolor. Nam ullamcorper malesuada leo, et molestie eros interdum nec. Quisque elementum eleifend nunc, quis malesuada lacus malesuada sed. Etiam vehicula orci quam, ut porta metus aliquam eget.'
            ],
            [
                'name'=>'Others',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mollis non dui non imperdiet. Maecenas id vulputate sem. Aliquam erat volutpat. In hac habitasse platea dictumst. Aliquam ac venenatis enim. Curabitur in urna sit amet justo commodo euismod quis ac magna. Duis tincidunt pretium magna, id vestibulum lorem tincidunt vel. Nulla vel metus vel dolor laoreet maximus. Fusce fermentum tortor nisl, vel pretium ligula efficitur vitae. Mauris rhoncus ante id nisi auctor, vitae tempus nibh congue. Fusce placerat erat ac aliquet rutrum. Nam felis orci, consectetur et eros id, fermentum tristique justo. Sed nisl enim, vulputate quis vulputate in, semper id dolor. Nam ullamcorper malesuada leo, et molestie eros interdum nec. Quisque elementum eleifend nunc, quis malesuada lacus malesuada sed. Etiam vehicula orci quam, ut porta metus aliquam eget.'
            ],            
        ]);

        $categories->each(function($category){
            
            factory(\App\DocumentCategory::class)->create([
                 'name' => $category['name'],   
                 'description' => $category['description'],              
            ]);
        });
    }
}
