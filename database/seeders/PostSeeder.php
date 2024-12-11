<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert(
            [
                [   
                    'id_user' => '1',
                    'title' => 'Chào mừng mọi người đến với Dâu Store',
                    'body' => 'Chào mừng bạn đến Dâu Store - điểm đến của những người đam mê thời trang! Tại đây, bạn sẽ khám phá những bộ trang phục và phụ kiện thời trang độc đáo, phong phú và phản ánh phong cách cá nhân của bạn. Hãy đến và cùng chúng tôi khám phá sự tinh tế và sang trọng trong từng sản phẩm!',
                    'image' => 'newdaustore.jpg',
                    'status' => '1',
                ],
                [
                    'id_user' => '1',
                    'title' => 'Ưu đãi đặc biệt dành cho khách hàng',
                    'body' => 'Ưu đãi giảm giá 50% cho tất cả các sản phẩm trên cửa hàng từ ngày 1/5 đến 10/5. Đừng bỏ lỡ cơ hội này!',
                    'image' => ' ',
                    'status' => '1',
                ],
                [
                    'id_user' => '1',
                    'title' => 'Bộ sưu tập mới cho mùa hè này',
                    'body' => 'Những bộ trang phục dễ thương và thoải mái cho mùa hè đã sẵn sàng. Đến cửa hàng ngay hôm nay để chọn lựa cho mình những món đồ mới nhất!',
                    'image' => 'bstmuahe.jpg',
                    'status' => '1',
                ],
            ]
        );
    }
}
