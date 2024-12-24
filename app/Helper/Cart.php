<?php
namespace App\Helper;
use PhpParser\Node\Stmt\Return_;
class Cart{
    public $items =[];
    private $total_quantity = 0;    
    private $total_peice = 0;
    public function __construct(){
        $this->items = session('cart') ? session('cart'):[];
    }
    public function list(){
        return $this->items;
    }
    public function add($sanpham, $quantity, $duong_dan, $selectedColors, $selectedSize, $ma_bien_the, $so_luong_ton)
        {
            // Tạo một mảng dữ liệu để thêm vào giỏ hàng
            $item = [
                'productId' => $sanpham->ma_san_pham,
                'name' => $sanpham->ten_san_pham,
                'bien_the' => $ma_bien_the,
                'color' => $selectedColors,
                'size' => $selectedSize,
                'price' => $sanpham->gia_ban,
                'image' => $duong_dan,
                'quantity' => $quantity,
                'soluongton'=>$so_luong_ton
            ];
            if (array_key_exists($ma_bien_the, $this->items)) {
                $this->items[$ma_bien_the]['quantity'] += $quantity;
            } else {
                $this->items[$ma_bien_the] = $item;
            }
            session(['cart' => $this->items]);
        }

        // public function getTotalPrice(){
        //     $totalPrice = 0;
        //     foreach ($this->items as $item) {
        //         $totalPrice += $item['price']*$item['quantity'];
        //     }
        //     return $totalPrice;
        // }
        public function getTotalQuan(){
            $total = 0;
            foreach ($this->items as $item) {
                $total += $item['quantity'];
            }
            return $total;
        }
}