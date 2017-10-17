<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function() {

	Route::resource('flowerReport_Transaction', 'InventoryTransaction_ReportController');

	Route::resource('floweradd', 'flowercontroller');

	Route::resource('acc', 'accesscontroller');

	Route::resource('bouquet', 'bouqcontroller');

	Route::get('/Adminbouquet_Creation',['uses' => 'Administrator_bouquet_Controller@Creation_of_bouquet', 'as'=>'Admin.Creation_Bouquet']);//shows the creation of bouquet in the server side

	Route::resource('bouqAdd_Flower_toAdmin_Bqt', 'AddingFlowers_ToAdminBqtSession_Controller');

	Route::resource('bouqAdd_Acrs_toAdmin_Bqt', 'AddingAcessories_ToAdminBqtSession_Controller');

  Route::resource('bouqAddFlower', 'Add_FlowerOnBouquet_Controller');

  Route::resource('bouqAddAcessories', 'Add_AcessoriesOnBouquet_Controller');

	Route::resource('supplieradd', 'suppcontroller');

	Route::resource('supplierMoreDetails', 'Supplier_Pricelist_Controller');

	Route::resource('Acessory_ADD_Qty', 'AcessoriesTransaction_Controller');

	//Route::resource('FlowerInventory_Transactions', 'FlowerInventory_Transaction_Controller');

	//Route::resource('AcrsInventory_Transactions', 'Inventory_Transaction_Controller');

	Route::resource('InventoryScheduling', 'InventoryScheduling_Controller');

	Route::resource('InventoryScheduling_Flowers', 'SchedulingFLowers_of_Inventory_Controller');

	Route::resource('InventoryArriving_Flowers', 'manageArriving_Flowers_controller');

	Route::get('/Cancel_ManagingRequests',['uses' => 'InventorySchedulingMaintenance_Controller@cancelmanaging_RequestedFlowers', 'as'=>'Requests.Cancelmanaging']);//shows the specific scheduled flower to be managed

	Route::get('/Specific_FlowersTobe_Managed/{Sched_id},{Flwr_id}',['uses' => 'InventorySchedulingMaintenance_Controller@Manage_FlowerTo_Submit', 'as'=>'Scheduled.SpecificFlower']);//shows the specific scheduled flower to be managed

	Route::get('/Specific_FlowersTobe_Adjusted/{Sched_id},{Flwr_id}',['uses' => 'InventorySchedulingMaintenance_Controller@Manage_FlowerTo_Adjust', 'as'=>'Adjust.SpecificFlower']);//shows the specific scheduled flower to be adjusted

	//Route::get('/Save_Managed_Flowers/{Sched_id}',['uses' => 'InventorySchedulingMaintenance_Controller@Save_FlowerTo_Inventory', 'as'=>'Save.managedRequests']);//saves the contents of the managed flower requests into the database

	Route::resource('Inventory_Flowers_toSession', 'Add_Flwr_toSessionInventory_Cart_Controller');

	Route::resource('Inventory_Flowers_toAdjustments', 'inventoryAdjustment_Controller');

	Route::resource('InventorySpoilage','spoiled_Monitoring_Controller');

	Route::resource('Admins', 'AdminAccounts_Controller');

	Route::get('deleteAdminAcct/{id}', ['uses' => 'AdminAccounts_Controller@destroy', 'as' => 'deleteAdminAcct']);

	Route::get('ShowAdminAcct/{id}', ['uses' => 'AdminAccounts_Controller@edit', 'as' => 'editAdminAcct']);

	Route::get('/inventoryTransactionFlowers', ['uses' => 'Inventory_Transaction_Controller@FlowerInventory_Trans', 'as' => 'FlowerInventory_Transactions']);

	Route::get('/inventoryTransactionAcrs', ['uses' => 'Inventory_Transaction_Controller@AcrsInventory_Trans', 'as' => 'AcrsInventory_Transactions']);


// Store
  //Route::resource('flowerReport_Transaction', 'InventoryTransaction_ReportController');


	Route::resource('flower', 'AddFlowerController');

	Route::resource('customers','customerListController');

	Route::resource('customersTradeAgreement','specificCustomerTradeAgreement_Controller');

	Route::resource('TradeAgreements','Trade_Agreement_Controller');

	Route::resource('Long_Sales_Order','longorderController');

	Route::resource('Quick_Sales_Order','quickorderController');

	Route::resource('ManageOrder_Bank','ManageOrder_bankController');

	Route::resource('ManageOrder_Cash','ManageOrder_CashController');

	Route::resource('ManageOrder_Check','ManageOrder_CheckController');

	Route::resource('ManageMultipleOrder_Cash','Cash_MultipleOrder_PaymentController');

	Route::resource('ManageMultipleOrder_Bank','Bank_MultipleOrder_PaymentController');

	Route::resource('ManageMultipleOrder_Check','Check_MultipleOrder_PaymentController');

	Route::get('/remove_debts_topayonlist/{id}',['uses' => 'OrderManagementController@remove_ordertopay', 'as'=>'SalesOrder.removeDebts']);

	Route::get('/Set_debts_topay/{id}',['uses' => 'OrderManagementController@add_ordertopay', 'as'=>'SalesOrder.payDebts']);

	Route::get('/Specific_Customer_debts/{id}',['uses' => 'OrderManagementController@show_debts', 'as'=>'SalesOrder.Debts']);

	Route::get('/Specific_Customer_Sales_Orders/{id}',['uses' => 'OrderManagementController@Show_Specific_customerWith_Debt', 'as'=>'SalesOrder.UnderCustomer']);

	Route::get('/SpecificSales_OrderPayingLater/{id}',['uses' => 'OrderManagementController@PaylaterSpecific_Order', 'as'=>'SalesOrderManage.PayLater']);

	Route::get('/SpecificSales_Order/{id}',['uses' => 'OrderManagementController@ManageSpecific_Order', 'as'=>'SalesOrderManage.Order']);

//checkot of longorder
  Route::get('/LongorderSummary',['uses' => 'OrderManagementController@ViewOrderSummary', 'as'=>'LongOrder.OrderSummary']);

	Route::get('/PaymentReceipt/{id}',['uses' => 'OrderManagementController@print_paymentSummary', 'as'=>'Payment.GenerateReceipt']);

	Route::get('/Receipt/{id}',['uses' => 'OrderManagementController@PrintReciept', 'as'=>'LongOrder.GenerateReceipt']);

	Route::get('/QuickReceipt/{id}',['uses' => 'OrderManagementController_Quick@PrintReciept', 'as'=>'QuickOrder.GenerateReceipt']);


	Route::resource('Sales_Qoutation','Order_Controller');

	Route::resource('Sales_Order','Specific_Order_Controller');

	Route::resource('Shop_Pricelist','Pricelist_Controller');

	Route::resource('product', 'productcontroller');


	Route::get('deletePrice_Markup/{id}', ['uses' => 'Pricelist_Controller@destroy',
	 'as' => 'Price.delete']);

	Route::resource('addtocart', 'addtocart');

	Route::get('addtocart/{id}', ['uses' => 'addtocart@deleteprod', 'as' => 'deleteprod']);

	Route::get('createbouquet', ['uses' => 'create_bouquet@floweracc', 'as' => 'flowerlist']);

	Route::post('AddFlowerToBouquet', ['uses' => 'create_bouquet@addflowerbouq', 'as' => 'addflowerbouq']);

	Route::post('AddAccess_ToBouquet', ['uses' => 'create_bouquet@addacc_bouqsession', 'as' => 'addaccbouq']);
//adds accessories to the temp accessories session

    Route::put('UpdateAccessories/{id}', ['uses' => 'create_bouquet@updateaccessories', 'as' => 'updateacc']);

//for the updating flowers in the temp bouquet session

	Route::put('updateQTY_Flower_bouquet/{id}', ['uses' => 'create_bouquet@Updating_FLower_inTempBoquet', 'as' => 'update_QtyFlower_bqtSession']);
//for the updating flowers in the temp bouquet session
	Route::get('deleteflower_SessionBqt/{id}', ['uses' => 'create_bouquet@deleteFlower_In_Bqt_Sesssion',
	 'as' => 'deleteboqFlower_temp']);
	 //for the deleting flowers in the temp bouquet session
	 	Route::get('deleteAcessories_SessionBqt/{id}', ['uses' => 'create_bouquet@deleteAcrs_In_Bqt_Sesssion',
	 	 'as' => 'deleteboqAcrs_temp']);
	 	 //for the deleting flowers in the temp bouquet session

	Route::get('AddFinal', ['uses' => 'create_bouquet@finalcheck', 'as' => 'finalcheck']);


	//Route::post('AddFinal', ['uses' => 'create_bouquet@finalcheck', 'as' => 'finalcheck']);

	Route::put('updateflower/{id}', ['uses' => 'addtocart@flowerUpdate', 'as' => 'updateflower']);

	Route::put('updateboquet/{id}', ['uses' => 'addtocart@boqupdate', 'as' => 'boqupdate']);

	//checkout controller

	Route::get('checkoutregistration', ['uses' => 'checkoutcontroller@checkingregistration', 'as' => 'checkingregistration']);

	Route::post('checkoutregistration', ['uses' => 'checkoutcontroller@checkAccountRegistration', 'as'=> 'checkRegistration']);

	Route::post('checkoutfinal', ['uses'=>'checkoutcontroller@userfinalCheckout', 'as' => 'checkoutfinal']);

	Route::post('checkoutfinalpickup', ['uses'=>'checkoutcontroller@checkoutfinalpickup', 'as' => 'checkoutfinalpickup']);

	Route::post('guestfinalpickup', ['uses' =>'checkoutcontroller@guestfinalpickup', 'as' => 'guestfinalpickup']);

	Route::post('guestdeliver', ['uses'=>'checkoutcontroller@guestdeliver','as'=> 'guestdeliver']);

	Route::get('PrintSummary/{id}', ['uses' => 'checkoutcontroller@PrintSummary', 'as' => 'printsummary']);

	Route::resource('Orders_Flowers','Manage_Flowers_on_Session_Order_Controller');

	Route::resource('QuickOrders_Flowers','Manage_Flowers_on_Session_QuickOrder_Controller');

	Route::resource('Orders_Bouquet','AddingFlowersto_OrderedBouquet_Controller');

	Route::resource('OrdersSession_Bouquet','AddFlowers_to_session_BQT');

	Route::resource('QuickSession_Bouquet','BouquetSession_Controller');

	Route::resource('QuickOrdersSession_Bouquet','AddFlowers_to_session_QuickBQT');

	Route::resource('OrdersAcSession_Bouquet','AddAcessory_to_session_BQT');

	Route::resource('QuickOrdersAcSession_Bouquet','AddAcessory_to_session_QuickBQT');


	Route::resource('Orders_BouquetAcessories','AddingAcessoriesto_OrderedBouquet_Controller');

	Route::resource('Orders_Submit_LongOrder','Orderlong_orderingController');

	Route::resource('QuickOrderSessionProcess','quickOrderProcess_Controller');


//validator
	Route::get('Validate_Email', 'Validator_Controller@CheckEmail_Existence');

	Route::get('Validate_UserName', 'Validator_Controller@CheckUsername_Existence');

	Route::get('Validate_Contact', 'Validator_Controller@Contact_Existence');

	//Route::get('/New_Notification', 'CheckingNotification_Controller@New_Notification');
	Route::get('Admin.Check_Notification', 'CheckingNotificationController@New_Notification');
  //to be continued

	Route::get('Order.Apply_CustTradeAgreement', 'Ordering_with_TradeAgreement_Controller@Apply_Trade_Agreement');
	Route::get('Order.Remove_CustTradeAgreement', 'Ordering_with_TradeAgreement_Controller@Apply_Price_Made_OnOrder_Creation');

	Route::get('QuickOrder.Apply_CustTradeAgreement', 'Ordering_with_TradeAgreement_Controller@Apply_Trade_Agreement_QuickOrder');
	Route::get('QuickOrder.Remove_CustTradeAgreement', 'Ordering_with_TradeAgreement_Controller@Apply_Price_Made_OnOrder_CreationQuickOrder');

	Route::get('/saveCustomized_Bouquet/{order_ID}',['uses' => 'OrderManagementController@saveCustomized_Bqt', 'as'=>'Bqtorder.saveBouquet']);//saves the newly created bqt


//Route::get('/removeDiscount/',['uses' => 'Ordering_with_TradeAgreement_Controller@Apply_Price_Made_OnOrder_Creation', 'as'=>'Order.Remove_CustTradeAgreement']);//for the view of adding flowers to order from the supplier
	//Route::get('/AddDiscount/',['uses' => 'Ordering_with_TradeAgreement_Controller@Apply_Trade_Agreement', 'as'=>'Order.Apply_CustTradeAgreement']);//for the view of adding flowers to order from the supplier

//Route::get('/emailcheck/',['uses' => 'Validator_Controller@CheckEmail_Existence', 'as'=>'Validate_Email']);//for the view of adding flowers to order from the supplier
//end of validator

Route::get('/Save_Created_Flower_request',['uses' => 'InventoryMonitoringController@save_requestFrom_Supplier', 'as'=>'InventorySched.Save_requestCreated']);//for the view of adding flowers to order from the supplier


Route::get('/Cancelrequest_Creation',['uses' => 'InventoryMonitoringController@Cancel_requestTo_Supplier', 'as'=>'InventorySched.Cancel_requestCreation']);//for the view of adding flowers to order from the supplier

Route::get('/FlowerSpoilage/{ID}',['uses'=>'InventoryMonitoringController@ManageSpoiledFlowers', 'as'=> 'manageBatch.Spoiled']);

Route::get('/ChooseFlowersForArrival/{flower_Id}',['uses' => 'InventoryMonitoringController@Delete_requestedflower_insession_toarrive', 'as'=>'InventorySched.RemoveFlower']);//for the view of adding flowers to order from the supplier


Route::get('/ChooseFlowersForArrival',['uses' => 'InventoryMonitoringController@View_AddingFlowers_for_Arrival', 'as'=>'Inventory.ScheduleArrival']);//for the view of adding flowers to order from the supplier

Route::get('/cancelCustomiztationOf_BQT',['uses' => 'OrderManagementController@Cancel_and_Clear_Bqt_Order', 'as'=>'Order.CancelBouquet']);

//'Flowerorder.DelOrderFlowers'
Route::get('/cancelCustomiztationOf_Bouquet/{order_ID}',['uses' => 'OrderManagementController@Cancel_and_ClearFlower_per_Bqt_Order', 'as'=>'Order.CancelCreateaBouquet']);


Route::get('/cancelCustomiztationOf_SessionBouquet',['uses' => 'OrderManagementController@Cancel_and_Clear_BqtSession_Order', 'as'=>'Order.CancelBouquetCreation']);




Route::get('/Release_Order/{id}',['uses' => 'OrderManagementController@release_Order', 'as'=>'order.Release_Order']);//redirects you to the confirmation of orders

Route::get('/Manage_ReleasingOrder/{id},{type}',['uses' => 'OrderManagementController@show_Order_ToRelease', 'as'=>'order.Manage_Releasing_Order']);//redirects you to the confirmation of orders

Route::get('/Manage_Confirmation/{id},{type}',['uses' => 'OrderManagementController@ShowSpecific_Confirmed_Orders', 'as'=>'order.Manage_Confirmed_Order']);//redirects you to the confirmation of orders

Route::get('/Order_NewConfirmation/',['uses' => 'OrderManagementController@ConfirmNewOrder', 'as'=>'order.ConfirmMyOrder']);//redirects you to the confirmation of orders

Route::get('/OrderConfirmation/',['uses' => 'OrderManagementController@ConfrimOrder', 'as'=>'order.ConfirmOrder']);//deletes a specific flower of a specific order

Route::get('/saveCustomized_Bouquet/{order_ID}',['uses' => 'OrderManagementController@saveCustomized_Bqt', 'as'=>'Bqtorder.saveBouquet']);//saves the newly created bqt


Route::get('/saveNewCustomized_Bouquet',['uses' => 'OrderManagementController@saveNewCustomized_Bqt', 'as'=>'Bqtorder.saveNewBouquet']);//saves the newly created bqt

Route::get('/saveNewQuickCustomized_Bouquet',['uses' => 'OrderManagementController_Quick@saveNewCustomized_Bqt', 'as'=>'BqtQuickorder.saveNewBouquet']);//saves the newly created bqt

Route::get('/order_creations',['uses' => 'OrderManagementController@return_to_CreationOfOrder', 'as'=>'return.orderCreation']);//saves the newly created bqt

Route::get('/cartClear',['uses' => 'OrderManagementController@Clear_Cart', 'as'=>'Order.ClearCart']);//saves the newly created bqt

Route::get('/QuickcartClear',['uses' => 'OrderManagementController_Quick@Clear_Cart', 'as'=>'QuickOrder.ClearCart']);//saves the newly created bqt

Route::get('/BqtClear',['uses' => 'OrderManagementController@Clear_Bouquet', 'as'=>'Order.ClearBqt']);//saves the newly created bqt

Route::get('/QuickBqtClear',['uses' => 'OrderManagementController_Quick@Clear_Bouquet', 'as'=>'QuickOrder.ClearBqt']);//saves the newly created bqt

Route::get('/AdminBqtClear',['uses' => 'Administrator_bouquet_Controller@Clear_AdminBouquet', 'as'=>'Order.ClearAdminBqt']);//saves the newly created bqt


Route::get('/OrderCustomizeofBQT',['uses' =>
	'CreationOfBouquet_Controller@show_Order_BQT_CustomizationPage', 'as'=>'Order.CustomizeaBouquet']);
//creates new bouquet

Route::get('/OrderCreationofCart/{Order_Id}',['uses' =>
	'CreationOfBouquet_Controller@show_Bouquet_Order_CustomizationPage', 'as'=>'Order.CreateaBouquet']);



	Route::get('/OrderManagement/{flower_ID}',['uses' => 'OrderManagementController@DeleteFlower_per_Order', 'as'=>'Flowerorder.DelOrderFlowers']);//deletes a specific flower of a specific order

	Route::get('/QuickOrderManagement/{flower_ID},{batch}',['uses' => 'OrderManagementController_Quick@DeleteFlower_per_QuickOrder', 'as'=>'Flowerorder.DelQuickOrderFlowers']);//deletes a specific flower of a specific quickorder

Route::get('/OrderBouquet_Acessories/{Acessory_ID},{order_ID}',['uses' => 'OrderManagementController@DeleteAcessory_per_Bqt_Order', 'as'=>'BqtAcessoryorder.DelOrderAcessories']);//deletes a specific flower of a specific bouquet in the creatin of bouquet


Route::get('/OrderSessionBouquet_Acessories/{Acessory_ID}',['uses' => 'OrderManagementController@DeleteAcessory_per_SessionBqt_Order', 'as'=>'Sessionorder.DelAcessories']);//deletes a specific flower of a specific bouquet of specific yorder

Route::get('/QuickOrderSessionBouquet_Acessories/{Acessory_ID}',['uses' => 'OrderManagementController_Quick@DeleteAcessory_per_SessionBqt_QuickOrder', 'as'=>'SessionQuickorder.DelAcessories']);//deletes a specific flower of a specific bouquet of specific yorder

Route::get('/AdminSessionBouquet_Acessories/{Acessory_ID}',['uses' => 'Administrator_bouquet_Controller@DeleteAcessory_per_SessionAdminBqt', 'as'=>'Admin.DelAcessories']);//deletes a specific flower of a specific bouquet of specific yorder


Route::get('/OrderBouquet_Flower/{flower_ID},{order_ID}',['uses' => 'OrderManagementController@DeleteFlower_per_Bqt_Order', 'as'=>'BqtFlowerorder.DelOrderFlowers']);//deletes a specific flower of a specific bouquet of specific order

Route::get('/OrderBQTSession_Flower/{flower_ID}',['uses' => 'OrderManagementController@DeleteFlower_per_Bqt_SessionOrder', 'as'=>'BqtFlowerorderSessions.DelOrderFlowers']);//deletes a specific flower of a specific bouquet

Route::get('/QuickOrderBQTSession_Flower/{flower_ID},{batch}',['uses' => 'OrderManagementController_Quick@DeleteFlower_per_Bqt_SessionQuickOrder', 'as'=>'BqtFlowerorderSessions.DelQuickOrderFlowers']);//deletes a specific flower of a specific bouquet

Route::get('/QuickOrderSession_bouquet/{Bouquet_ID}',['uses' => 'OrderManagementController_Quick@Delete_Bouquet', 'as'=>'BqtorderSessions.DelQuickBouquet']);//deletes a specific flower of a specific bouquet

Route::get('/AdminBQTSession_Flower/{flower_ID}',['uses' => 'Administrator_bouquet_Controller@DeleteFlower_per_AdminBqt_Session', 'as'=>'AdminBqtFlowerorderSessions.DelOrderFlowers']);//deletes a specific flower of a specific bouquet


Route::get('/BouquetMaintenance/{bouquet_ID},{flower_ID},{QTY},{T_PRICE}',['uses' => 'BouquetMaintenanceController@DeleteFlower_per_Bouquet', 'as'=>'bouq.DelFlowerBouquet']);

Route::get('/BouquetAcessoryMaintenance/{bouquet_ID},{acessory_ID}',['uses' => 'BouquetMaintenanceController@DeleteAcessories_per_Bouquet', 'as'=>'bouq.DelAcessoryBouquet']);

Route::get('/inventoryMonitoring/{flower_ID}',['uses' => 'InventoryMonitoringController@viewInventory_per_Flower', 'as'=>'inv.viewFlowerInventory']);


Route::get('/del-from-schedule/{id},{flower_ID}',['uses' => 'InventorySchedulingMaintenance_Controller@deleteFlowerOnSched', 'as'=>'flower.deletefromList']);

Route::get('/cancelorder-from-spplier/{id}',['uses' => 'InventorySchedulingMaintenance_Controller@cancelOrdersFromSupplier', 'as'=>'schedule.cancel']);


Route::get('supplier', 'PagesController@getSupplierList');

Route::get('suppliermoredetails', 'PagesController@getSupplierMoreDetails');

Route::get('customer', 'PagesController@getCustomerList');

Route::get('specificsupplierpricelist', 'PagesController@getSpecificSupplierPriceList');

Route::get('addingtradeagreement', 'PagesController@getAddingTradeAgreement');

Route::get('customertradeagreement', 'PagesController@getCustomerTradeAgreement');

Route::get('specificcustomeragreement', 'PagesController@getSpecificCustomerAgreement');

Route::get('otherviewofcustagreement', 'PagesController@getOtherViewOfCustAgreement');

Route::get('inventorytransaction', 'PagesController@getInventoryTransaction');

//Route::get('bouquet', 'PagesController@getBouquet');

Route::get('specific_bouquet_details', 'PagesController@getSpecificBouquetDetails');

Route::get('list_of_bouquets', 'PagesController@getListOfBouquets');

Route::get('dashboard', ['uses'=> 'PagesController@getDashboard', 'as' => 'dashboard']);

//Route::get('dashboard', 'PagesController@getDashboard');

Route::get('quickorder', 'PagesController@getQuickOrder');

Route::get('longorder', 'PagesController@getLongOrder');

Route::get('ordersummary', 'PagesController@getOrderSummary');

Route::get('shippingmethod', 'PagesController@getShippingMethod');

Route::get('paymentmethod', 'PagesController@getPaymentMethod');

Route::get('finalorder', 'PagesController@getFinalOrder');


Route::get('flowers', 'PagesController@getFlowers');

Route::get('bouquets', 'PagesController@getBouquets');

Route::get('deco', 'PagesController@getDeco');

Route::get('about', 'PagesController@getAbout');

Route::get('cart', 'PagesController@getCart');

Route::get('checkout', 'PagesController@getCheckout');

Route::get('contact', 'PagesController@getContact');

Route::get('loginx', 'PagesController@getLogin');

Route::get('register', 'PagesController@getRegister');

Route::get('wedding', 'PagesController@getWedding');

Route::get('product_detail', 'PagesController@getProductDetail');

Route::get('home', ['uses' => 'PagesController@getHome', 'as' => 'homepages']);

Route::get('bouquets', ['uses'=>'ClientController@bouquetlist', 'as'=>'bouquets']);

Route::get('flowers', ['uses' => 'ClientController@flowerlist', 'as' => 'customer_side.pages.flower']);

Route::get('/deleteproduct/{id}', ['uses'=> 'addtocartprod@deleteprod', 'as'=> 'deleteprodinCart']);

Route::get('/deleteboq/{id}', ['uses'=> 'addtocartprod@deletboquet', 'as'=> 'deleteboquet']);


Route::get('create_bouquet', 'PagesController@getCreateBouquet');

Route::get('Login', 'PagesController@getLoginPage');

Route::get('summarypickup', 'PagesController@getOrderSummaryPickUp');

Route::get('editacc', 'PagesController@getEditAccount');

//Cashier Dashboard

Route::get('cashier', 'PagesController@getCashierPage');

Route::get('cashier_dashboard', ['uses' => 'PagesController@getCashierDashboard','as' => 'cashierdashboard']);

Route::get('cashier_sales_order', ['uses' => 'PagesController@getCashierSalesOrder','as' => 'cashiersalesorder']);

Route::get('cashier_quick_order', ['uses' => 'PagesController@getCashierQuickOrder','as' => 'cashierquickorder']);

Route::get('cashier_long_order', ['uses' => 'PagesController@getCashierLongOrder','as' => 'cashierlongorder']);

Route::get('cashier_customer_list', ['uses' => 'PagesController@getCashierCustomerList','as' => 'cashiercustomerlist']);

Route::get('cashier_customer_trade_agreement', ['uses' => 'PagesController@getCashierCustomerTradeAgreement','as' => 'cashiercustomertradeagreement']);

Route::get('cashier_flower_list', ['uses' => 'PagesController@getCashierFlowerList','as' => 'cashierflowerlist']);

Route::get('cashier_inventory_transaction', ['uses' => 'PagesController@getCashierInventoryTransaction','as' => 'cashierinventorytransaction']);

Route::get('cashier_flower_price_list', ['uses' => 'PagesController@getCashierFlowerPriceList','as' => 'cashierflowerpricelist']);






//end Cashier

Route::get('OrderSummaryPickUp', 'PagesController@getOrderSummaryPickUp');

Route::get('OrderSummaryDelivery', 'PagesController@getOrderSummaryDelivery');

Route::get('OrderSummaryPickUpDesign', 'PagesController@getOrderSummaryPickUpDesign');

Route::get('OrderSummaryDeliveryDesign', 'PagesController@getOrderSummaryDeliveryDesign');

Route::get('OrderSummaryPickUpSimple', 'PagesController@getOrderSummaryPickUpSimple');

Route::get('OrderSummaryDeliverySimple', 'PagesController@getOrderSummaryDeliverySimple');

//warehouse route

Route::get('inventory_dashboard', ['uses' =>'PagesController@getInventoryDashboard', 'as' => 'warehousedashboard']);

Route::get('inventory_sales_order', ['uses' =>'PagesController@getInventorySalesOrder', 'as' => 'inventorysalesorder']);

Route::get('inventory_flower_list', ['uses' =>'PagesController@getInventoryFlowerList', 'as' => 'inventoryflowerlist']);

Route::get('inventory_side_transaction', ['uses' =>'PagesController@getInventorySideTransaction', 'as' => 'inventorysidetransaction']);

Route::get('inventory_side_schedule', ['uses' =>'PagesController@getInventorySchedule', 'as' => 'inventorysideschedule']);

Route::get('inventory_flower_price_list', ['uses' =>'PagesController@getInventoryFlowerPriceList', 'as' => 'inventoryflowerpricelist']);


// end of warehouseroute

Route::get('ViewAccountDetails', ['uses' => 'ClientController@getEditAccount', 'as' => 'geteditaccount']);

Route::put('EditAccountDetails/{id}', ['uses' => 'ClientController@postEditAccount', 'as' => 'posteditaccount']);

Route::get('pickup', ['uses' => 'create_bouquet@pickupreports', 'as' => 'summarypickup']);

Route::get('WonderbloomFlowershop', 'PagesController@getLandingPage');

Route::post('Change Password', ['uses'=> 'ClientController@changepassword', 'as' => 'changepassword']);

Route::get('view_bouquet/{id}', ['uses'=>'create_bouquet@getViewBouquet', 'as' => 'viewbouquet']);

Route::post('Add Default Boquet', ['uses' => 'create_bouquet@defaultboqadd', 'as' => 'adddefaultboq']);

Route::get('sales_report', 'PagesController@getSalesReport');

Route::get('inventory_reports_batch', 'PagesController@getInventoryReportsBatch');

Route::get('signup_page', ['uses' => 'PagesController@getSignupPage', 'as' => 'postsignin']);

Route::get('inventory_reports_flower', 'PagesController@getInventoryReportsFlower');

Route::get('order_confirmation/{id}', ['uses'=>'PagesController@getOrderConfirmation','as'=>'guestorder']);

Route::get('guestprinting/{id}', ['uses' => 'PagesController@guestprint', 'as'=>'guestprint']);

Route::post('CheckoutSignin', ['uses' => 'ClientController@CheckoutSignin', 'as' => 'checkoutsignin']);

Route::get('inventory_side_flower_transaction', 'PagesController@getInventorySideFlowerTransaction');

Route::get('inventory_side_acc_transaction', 'PagesController@getInventorySideAccTransaction');


    Route::get('AdminLogin', [
        'uses'=>'PagesController@getLoginPage',
        'as'=>'AdminLogin',

    ]);

    Route::post('AdminLogin', [
        'uses' => 'AdminAccounts_Controller@postSignin',
        'as' => 'adminsignin',

    ]);


    Route::get('AdminLogin', [
        'uses'=>'PagesController@getLoginPage',
        'as'=>'AdminLogin',

    ]);

    Route::post('AdminLogin', [
        'uses' => 'AdminAccounts_Controller@postSignin',
        'as' => 'adminsignin',

    ]);


    Route::get('adminlogout',[
        'uses' => 'AdminAccounts_Controller@AdminLogout',
        'as' => 'adminlogout',

    ]);

    Route::post('AdminSignup', ['uses' => 'AdminAccounts_Controller@AdminPostSignup', 'as' => 'AdminSignup']);

    Route::post('AdminSignin', ['uses' => 'AdminAccounts_Controller@AdminPostSignin', 'as' => 'AdminSignin']);



//View Reports

Route::group(['prefix' => 'user'], function() {

	Route::group(['middleware' => 'guest'], function (){
		Route::get('register', [
			'uses' => 'ClientController@getSignup',
			'as' => 'customer_side.pages.signup',
			'middleware' => 'guest'
		]);

		Route::post('register', [
			'uses' => 'ClientController@postSignup',
			'as' => 'customer_side.pages.signup',
			'middleware' => 'guest'
		]);

		Route::get('loginx', [
			'uses' => 'ClientController@getSignin',
			'as' => 'customer_side.pages.signin',
			'middleware' => 'guest'
			]);

		Route::post('loginx', [
			'uses' => 'ClientController@postSignin',
			'as' => 'customer_side.pages.signin',
			'middleware' => 'guest'
		]);



	});


	Route::group(['middleware' => 'auth'], function (){



		Route::get('logout', [
			'uses' => 'ClientController@getLogout',
		  'as' => 'customer_side.pages.logout',
		  'middleware' => 'auth'
	 ]);




    });



});

});
