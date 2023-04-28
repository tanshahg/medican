<div id="app">
  <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar sticky">
      <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
          collapse-btn"> <i data-feather="align-justify"></i></a></li>
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
            <i data-feather="maximize"></i>
          </a></li>
          
        </ul>
      </div>
      <ul class="navbar-nav navbar-right">
        
        <li class="dropdown"><a href="#" data-toggle="dropdown"
          class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/fake-user.png"
          class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
          <div class="dropdown-menu dropdown-menu-right pullDown">
            <div class="dropdown-title">Hello <?php echo $currentuser ?></div>
            
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div class="main-sidebar sidebar-style-2"  style="display:hidden">
      <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
          <a href="admin.php"> <img alt="image" src="assets/img/logo2.png" class="header-logo" />
          </a>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-header">Main</li>
          <li class="dropdown">
            <a href="admin.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
          </li>
          <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i
              data-feather="book"></i><span>Profiles</span></a>
              <ul class="dropdown-menu">
               
                  <li ><a class="nav-link" href="customer-list.php">Customer Profile</a></li>
                  <li ><a class="nav-link" href="product-list.php">Product Profile</a></li>
                  <li ><a class="nav-link" href="company-list.php">Company Profile</a></li>
                  <li ><a class="nav-link" href="saleman-list.php">Sales Man Profile</a></li>
                  <li ><a class="nav-link" href="fieldofficer-list.php">Field Force Profile</a></li>
                  
                  <li ><a class="nav-link" href="companygroup-list.php">Group Profile</a></li>
                  <li ><a class="nav-link" href="formula-list.php">Formula Information</a></li>
                  
                  <li ><a class="nav-link" href="area-list.php">Area Profile</a></li>
                  <li ><a class="nav-link" href="courier-list.php">Courier Profile</a></li>
                  <li ><a class="nav-link" href="mode-list.php">Customer Mode</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="book-open"></i><span>Purchase</span></a>
                <ul class="dropdown-menu">
                  <li ><a class="nav-link" href="purchase.php">Purchase Invoice</a></li>
                  <li ><a class="nav-link" href="purchasereturn.php">Purchase Return</a></li>
                  <li ><a class="nav-link" href="purchase-list.php">Purchase Report</a></li>
                  <li ><a class="nav-link" href="purchase-summary.php">Purchase Summary</a></li>
                  
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-bag"></i><span>Sale</span></a>
                <ul class="dropdown-menu">
                  <li ><a class="nav-link" href="sale.php">Sale Invoice</a></li>
                  <li ><a class="nav-link" href="printinvoice.php">Print Sale Invoice</a></li>
                  <!-- <li ><a class="nav-link" href="salereturn.php">Sale Return</a></li> -->
                  <li ><a class="nav-link" href="dailyinvoice.php">Daily Invoice</a></li>
                  <li ><a class="nav-link" href="stocksummary.php">Daily Stock Wise Invoice</a></li>
                  <li ><a class="nav-link" href="sale-list.php">Sale Detail Report</a></li>
                  <li ><a class="nav-link" href="salemanwise.php">Saleman Wise Daily Report</a></li>
                  <li ><a class="nav-link" href="sale-summary.php">Sale Summary</a></li>
                  <li ><a class="nav-link" href="obsareawise.php">Area Wise Business</a></li>
                  <li ><a class="nav-link" href="customerwise.php">Customer Wise Business</a></li>
                  <li ><a class="nav-link" href="customer-product-wise.php">Customer/product Wise Business</a></li>
                  
                  
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Cash Vouchers</span></a>
                <ul class="dropdown-menu">
                  
                  <li ><a class="nav-link" href="rvouchersimple-list.php">Receipt Voucher Simple</a></li>
                  <li ><a class="nav-link" href="rvoucheradvance-list.php"> Receipt Voucher Advance</a></li>
                  <li ><a class="nav-link" href="recivedvoucher-summary.php"> Receipt Voucher Summary</a></li>
                  <li ><a class="nav-link" href="payment-voucher.php"> Payment Voucher</a></li>
                  <li ><a class="nav-link" href="paymentvoucher-summary.php"> Payment Voucher Summary</a></li>
                  <li ><a class="nav-link" href="expense-voucher.php"> Expense  Voucher</a></li>
                  <li ><a class="nav-link" href="accountledger.php">Account Ledger</a></li>
                  
                  
                  
                  
                  
                  
                </ul>
              </li>
              
              
              
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="life-buoy"></i><span>Company Report</span></a>
                <ul class="dropdown-menu">
                  <li ><a class="nav-link" href="account-daily.php">Account Wise Daily Report</a></li>
                  <li ><a class="nav-link" href="fdataformat.php">Franchise Data Format</a></li>
                  <li ><a class="nav-link" href="lblsale.php">LBL Sale Report</a></li>
                  <li ><a class="nav-link" href="sas/">SAS Zip Download</a></li>
                  
                  
                  
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="database"></i><span>Stock Report</span></a>
                <ul class="dropdown-menu">
                  <li ><a class="nav-link" href="stockdetail.php">Stock Detail</a></li>
                  <li ><a class="nav-link" href="stockbatchdetail.php">Stock Batch Detail</a></li>
                  <li ><a class="nav-link" href="sale-stockreport.php">Stock Sale Report</a></li>
                  <li ><a class="nav-link" href="stockbonus.php">Stock Sale Bonus Report</a></li>
                  
                  <li ><a class="nav-link" href="customerbalance.php">Customer Balance Sheet</a></li>
                  <li ><a class="nav-link" href="itemhistory.php">Item Hisotry</a></li>
                  <li ><a class="nav-link" href="companyhistory.php">Compnay Hisotry</a></li>
                  <li ><a class="nav-link" href="expiry.php">Expiry</a></li>
                  <li ><a class="nav-link" href="bonus-claim.php">Bonus Claim</a></li>
                  <li ><a class="nav-link" href="discount-claim.php">Discount Claim</a></li>
                  
                  
                  
                </ul>
              </li>
              
              
              
              <?php if($currentuser=="admin")
              {
              ?>
              
              <li class="dropdown">
                <a href="userm.php" class="nav-link"><i data-feather="users"></i><span>User Management</span></a>
              </li>
              
              <li class="dropdown">
                <a href="backup/" class="nav-link"><i data-feather="database"></i><span>Backup</span></a>
              </li>
              <?php
              }
              ?>
              
              <li class="dropdown">
                <a data-toggle="modal" data-target="#calc" class="nav-link" style="cursor: pointer" ><i data-feather="clipboard"></i><span>Calculator</span></a>
              </li>
              
            </ul>
          </aside>
        </div>