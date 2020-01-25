<?php


class Order extends Db_object
{
    protected static $db_table = "orders";
    protected static $db_table_fields = array('id','user_id','username','total_price','date_order','address','transactionID');
    public $id;
    public $total_price;
    public $user_id;
    public $date_order;
    public $username;
    public $transactionID;
    public $address;

    public static function create_order($user_id, $total_price, $username, $address, $date_order,$transactionID){
        if(!empty($user_id) && !empty($total_price) && !empty($username) && !empty($address)&& !empty($date_order) && !empty($transactionID)){
            $order = new Order();
            $order->user_id = (int)$user_id;
            $order->price = $total_price;
            $order->username = $username;
            $order->address = $address;
            $order->date_order = $date_order;
            $order->transactionID = $transactionID;
            return $order;
        }else{
            return false;
        }
    }

    public static function find_the_orders($user_id){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE user_id = " . $database->escape_string ($user_id);
        $sql .= " ORDER BY user_id ASC";
        return self::find_this_query ($sql);
    }

    public  static function verify_transactionID($transactionID){
        global $database;
        $transactionID= $database->escape_string($transactionID);
        $sql = "SELECT * FROM " .self::$db_table. " WHERE ";
        $sql .= "transactionID = '{$transactionID}' ";
        $sql .= "LIMIT 1";
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }




    // 2. Set up your server to receive a call from the client
    /**
     *You can use this function to retrieve an order by passing order ID as an argument.
     */
    public static function getOrder($orderId)
    {

        // 3. Call PayPal to get the transaction details
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($orderId));
        /**
         *Enable the following line to print complete response as JSON.
         */
        //print json_encode($response->result);
        print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->status}\n";
        print "Order ID: {$response->result->id}\n";
        print "Intent: {$response->result->intent}\n";
        print "Links:\n";
        foreach($response->result->links as $link)
        {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
        print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

        // To print the whole response body, uncomment the following line
        // echo json_encode($response->result, JSON_PRETTY_PRINT);
    }


/**
 *This driver function invokes the getOrder function to retrieve
 *sample order details.
 *
 *To get the correct order ID, this sample uses createOrder to create a new order
 *and then uses the newly-created order ID with GetOrder.
 */


}