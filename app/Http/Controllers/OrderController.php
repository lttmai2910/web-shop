<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

require_once('Config.php');

class OrderController extends Controller 
{
    public function pay(Request $request): Response
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
        return Inertia::render('Public/Cart/Pay', [
            'cart' => $cart,
        ]);
    }

    public function checkout(Request $request): RedirectResponse
    {
    $cart = $request->session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    // Kiểm tra khách hàng hiện tại hoặc tạo mới
    $customer = Customer::firstOrCreate(
        ['email' => $request->input('email')],
        [
            'name_customer' => $request->input('name_customer'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => bcrypt('default_password'), // Thêm giá trị mật khẩu mặc định
            'status' => 1,

        ]
    );

        // Tạo đơn hàng mới
        $order = new Order();
        $order->id_customer = $customer->id;
        $order->name_customer = $request->input('name_customer');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->address = $request->input('address');
        $order->note = $request->input('note');
        $order->total_amount = $this->calculateTotalPrice($cart);
        $order->date_order = Carbon::now()->toDateString();
        $order->time_order = Carbon::now()->toTimeString();
        $order->name_payment = $request->input('name_payment'); // Phương thức thanh toán
        $order->status = '0'; // Trạng thái đơn hàng (chờ xử lý)

        $order->save();
        
        $array = [];
        // Lưu chi tiết đơn hàng (order details)
        foreach ($cart as $item) {
            $orderDetail = new OrderDetail();
            // Tạo một bản ghi OrderDetail mới            
            // Đặt các giá trị cho bản ghi OrderDetail
            $orderDetail->id_order = $order->id; // Lấy id của đơn hàng mới tạo
            $orderDetail->id_product_item = $item['id']; // Lấy id của sản phẩm từ giỏ hàng
            $array = $item['sizes'];
            foreach ($array as $x)
            {
                $orderDetail->size = $x; // Lấy kích thước sản phẩm từ giỏ hàng
            }
            $orderDetail->discount_price = $item['discount_price']; // Lấy giá sản phẩm từ giỏ hàng
            $orderDetail->quantity = $item['quantity']; // Lấy số lượng sản phẩm từ giỏ hàng
        
            // Thêm các trường thông tin khác nếu cần
            $orderDetail->save();
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        $request->session()->forget('cart');

        return redirect()->route('cart')->with('success', 'Đơn hàng đã được đặt thành công!');
    }

    private function calculateTotalPrice(array $cart): float
    {
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['quantity'] * $item['discount_price']; // Sử dụng giá giảm giá
        }

        return $totalPrice;
    }

    public function index(): Response
    {
        $order = Order::latest()->paginate(10);
        return Inertia::render('Admin/Order/Index', ['order'=>$order]);
    }

    public function destroy($id): RedirectResponse
    {
    // Tìm đơn hàng
    $order = Order::find($id);

    if ($order) {
        // Tìm các chi tiết đơn hàng liên quan
        $orderDetails = OrderDetail::where('id_order', $order->id)->get();

        // Xóa các chi tiết đơn hàng
        foreach ($orderDetails as $orderDetail) {
            $orderDetail->delete();
        }

        // Xóa đơn hàng
        $order->delete();

        return Redirect::route('order.index')->with('success', 'Đơn hàng và các chi tiết đơn hàng đã được xóa thành công!');
    }

    return Redirect::route('order.index')->with('error', 'Không tìm thấy đơn hàng.');
    }


    public function edit(Order $order)
    {
        return Inertia::render('Admin/Order/Edit', ['order'=>$order]);
    }

    public function update($id, Request $request): RedirectResponse
    {
            Order::find($id)->update([
                'name_customer' => $request->name_customer,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note,
                'total_amount' => $request->total_amount,
                'date_order' => $request->date_order,
                'time_order' => $request->time_order,
                'name_payment' => $request->name_payment,
                'status' => $request->status,
            ]);
            return Redirect::route('order.index');
    }

    public function show($id): Response
    {
        $order = Order::findOrFail($id);
        $orderdetails = OrderDetail::where('id_order', $id)->get();
    
        // Fetch product_name for each order detail item
        foreach ($orderdetails as $detail) {
            $product = DB::table('products')
                        ->where('id', $detail->id_product_item)
                        ->select('product_name')
                        ->first();
            $detail->product_name = $product->product_name ?? 'N/A';
        }

        
    
        return Inertia::render('Admin/Order/Show', ['order' => $order, 'orderdetails' => $orderdetails]);
    }
    
}   
