
// Complete Order After 2 days
add_action('init', 'wp_orders');
function wp_orders()
{

   
    global $wpdb;
    $my_query = "SELECT * FROM wp_wc_order_stats where STATUS='wc-processing'";
    $val123   = $wpdb->get_row($my_query, OBJECT);
    $result2  = $wpdb->get_results($my_query);
    foreach ($result2 as $results2) {
        $date1    = $results2->date_created_gmt;
        $order_id = $results2->order_id;

        $date2 = date("Y-m-d h:i:s");

        $dteStart = new DateTime($date1);
        $dteEnd   = new DateTime($date2);
        $dteDiff  = $dteStart->diff($dteEnd);
        $Diff     = $dteDiff->format("%d");
        $int      = (int) $Diff;
       
        if ($int >= 2) {
            $order = new WC_Order($order_id);
            if (!empty($order)) {
                $order->update_status('completed');
            }
        }
    }
   

}
