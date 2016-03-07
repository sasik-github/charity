<?php

use Illuminate\Database\Seeder;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $about = \App\Models\About::find(1);
        if ($about) {
            $about->delete();
        }


        \App\Models\About::create([
            'id' => 1,
            'text' => '
                <h1>О Компании</h1>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consequatur, magnam nihil nulla optio quia unde. Asperiores aspernatur at cupiditate dolores impedit laborum minima nisi odit officia placeat quas, quis reiciendis suscipit ullam voluptatem! Commodi deleniti dignissimos ipsa minus necessitatibus nobis perspiciatis repellat repellendus? Dignissimos ducimus placeat praesentium quaerat veritatis. Ab accusantium asperiores consequuntur deleniti eligendi et ex, harum illum iste iure laboriosam necessitatibus odio porro quaerat quis, rem saepe tempora tempore ut veritatis? Amet, hic laudantium rerum sed soluta tenetur veniam? Adipisci atque consectetur distinctio dolores enim esse illo libero minima odit placeat qui quisquam, rem reprehenderit sit veritatis.</p>

                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, quo.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, itaque!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, itaque!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, itaque!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, itaque!</li>
                </ul>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias animi assumenda atque corporis cum cupiditate dicta ducimus ea enim et ex expedita explicabo hic illo ipsum itaque labore molestiae nesciunt nihil numquam, odio odit officia omnis quas qui quia quo, quos rem repellendus saepe sunt totam vitae voluptate voluptates.</p>

            '
        ]);
    }
}
