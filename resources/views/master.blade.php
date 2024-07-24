@extends('main')

@section('title', 'Master')

@section('page')
<div class="page-container">	
    <div class="left-content">
        <div class="mother-grid-inner">
             <!--header start here-->
                 <div class="header-main">
                     <div class="header-left">
                             <div class="logo-name">
                                      <a href="index.html"> <h1>SORA</h1> 
                                     <!--<img id="logo" src="" alt="Logo"/>--> 
                                   </a> 								
                             </div>
                             <!--search-box-->
                                 <div class="search-box">
                                     <form>
                                         <input type="text" placeholder="Search..." required="">	
                                         <input type="submit" value="">					
                                     </form>
                                 </div><!--//end-search-box-->
                             <div class="clearfix"> </div>
                          </div>
                          <div class="header-right">
                             <div class="profile_details_left"><!--notifications of menu start -->
                                 <ul class="nofitications-dropdown">
                                     <li class="dropdown head-dpdn">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                                         <ul class="dropdown-menu">
                                             <li>
                                                 <div class="notification_header">
                                                     <h3>You have 3 new messages</h3>
                                                 </div>
                                             </li>
                                             <li><a href="#">
                                                <div class="user_img"><img src="{{ asset('style/images/p4.png') }}" alt=""></div>
                                                <div class="notification_desc">
                                                 <p>Lorem ipsum dolor</p>
                                                 <p><span>1 hour ago</span></p>
                                                 </div>
                                                <div class="clearfix"></div>	
                                             </a></li>
                                             <li class="odd"><a href="#">
                                                 <div class="user_img"><img src="images/p2.png" alt=""></div>
                                                <div class="notification_desc">
                                                 <p>Lorem ipsum dolor </p>
                                                 <p><span>1 hour ago</span></p>
                                                 </div>
                                               <div class="clearfix"></div>	
                                             </a></li>
                                             <li><a href="#">
                                                <div class="user_img"><img src="images/p3.png" alt=""></div>
                                                <div class="notification_desc">
                                                 <p>Lorem ipsum dolor</p>
                                                 <p><span>1 hour ago</span></p>
                                                 </div>
                                                <div class="clearfix"></div>	
                                             </a></li>
                                             <li>
                                                 <div class="notification_bottom">
                                                     <a href="#">See all messages</a>
                                                 </div> 
                                             </li>
                                         </ul>
                                     </li>
                                     <li class="dropdown head-dpdn">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                                         <ul class="dropdown-menu">
                                             <li>
                                                 <div class="notification_header">
                                                     <h3>You have 3 new notification</h3>
                                                 </div>
                                             </li>
                                             <li><a href="#">
                                                 <div class="user_img"><img src="images/p5.png" alt=""></div>
                                                <div class="notification_desc">
                                                 <p>Lorem ipsum dolor</p>
                                                 <p><span>1 hour ago</span></p>
                                                 </div>
                                               <div class="clearfix"></div>	
                                              </a></li>
                                              <li class="odd"><a href="#">
                                                 <div class="user_img"><img src="images/p6.png" alt=""></div>
                                                <div class="notification_desc">
                                                 <p>Lorem ipsum dolor</p>
                                                 <p><span>1 hour ago</span></p>
                                                 </div>
                                                <div class="clearfix"></div>	
                                              </a></li>
                                              <li><a href="#">
                                                 <div class="user_img"><img src="images/p7.png" alt=""></div>
                                                <div class="notification_desc">
                                                 <p>Lorem ipsum dolor</p>
                                                 <p><span>1 hour ago</span></p>
                                                 </div>
                                                <div class="clearfix"></div>	
                                              </a></li>
                                              <li>
                                                 <div class="notification_bottom">
                                                     <a href="#">See all notifications</a>
                                                 </div> 
                                             </li>
                                         </ul>
                                     </li>	
                                     <li class="dropdown head-dpdn">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
                                         <ul class="dropdown-menu">
                                             <li>
                                                 <div class="notification_header">
                                                     <h3>You have 8 pending task</h3>
                                                 </div>
                                             </li>
                                             <li><a href="#">
                                                 <div class="task-info">
                                                     <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                     <div class="clearfix"></div>	
                                                 </div>
                                                 <div class="progress progress-striped active">
                                                     <div class="bar yellow" style="width:40%;"></div>
                                                 </div>
                                             </a></li>
                                             <li><a href="#">
                                                 <div class="task-info">
                                                     <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                    <div class="clearfix"></div>	
                                                 </div>
                                                 <div class="progress progress-striped active">
                                                      <div class="bar green" style="width:90%;"></div>
                                                 </div>
                                             </a></li>
                                             <li><a href="#">
                                                 <div class="task-info">
                                                     <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                     <div class="clearfix"></div>	
                                                 </div>
                                                <div class="progress progress-striped active">
                                                      <div class="bar red" style="width: 33%;"></div>
                                                 </div>
                                             </a></li>
                                             <li><a href="#">
                                                 <div class="task-info">
                                                     <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                    <div class="clearfix"></div>	
                                                 </div>
                                                 <div class="progress progress-striped active">
                                                      <div class="bar  blue" style="width: 80%;"></div>
                                                 </div>
                                             </a></li>
                                             <li>
                                                 <div class="notification_bottom">
                                                     <a href="#">See all pending tasks</a>
                                                 </div> 
                                             </li>
                                         </ul>
                                     </li>	
                                 </ul>
                                 <div class="clearfix"> </div>
                             </div>
                             <!--notification menu end -->
                             <div class="profile_details">		
                                 <ul>
                                     <li class="dropdown profile_details_drop">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                             <div class="profile_img">	
                                                 <span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
                                                 <div class="user-name">
                                                     <p>Malorum</p>
                                                     <span>Administrator</span>
                                                 </div>
                                                 <i class="fa fa-angle-down lnr"></i>
                                                 <i class="fa fa-angle-up lnr"></i>
                                                 <div class="clearfix"></div>	
                                             </div>	
                                         </a>
                                         <ul class="dropdown-menu drp-mnu">
                                             <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                                             <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                                             <li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                         </ul>
                                     </li>
                                 </ul>
                             </div>
                             <div class="clearfix"> </div>				
                         </div>
                      <div class="clearfix"> </div>	
                 </div>
 <!--heder end here-->
 <!-- script-for sticky-nav -->
         <script>
         $(document).ready(function() {
              var navoffeset=$(".header-main").offset().top;
              $(window).scroll(function(){
                 var scrollpos=$(window).scrollTop(); 
                 if(scrollpos >=navoffeset){
                     $(".header-main").addClass("fixed");
                 }else{
                     $(".header-main").removeClass("fixed");
                 }
              });
              
         });
         </script>
         <!-- /script-for sticky-nav -->
 <!--inner block start here-->
 <div class="inner-block">
 <!--market updates updates-->
      <div class="market-updates">
             <div class="col-md-4 market-update-gd">
                 <div class="market-update-block clr-block-1">
                     <div class="col-md-8 market-update-left">
                         <h3>0</h3>
                         <h4>Server</h4>
                     </div>
                     <div class="col-md-4 market-update-right">
                         <i class="fa fa-file-text-o"> </i>
                     </div>
                   <div class="clearfix"> </div>
                 </div>
             </div>
             <div class="col-md-4 market-update-gd">
                 <div class="market-update-block clr-block-2">
                  <div class="col-md-8 market-update-left">
                     <h3>0</h3>
                     <h4>Trouble</h4>
                   </div>
                     <div class="col-md-4 market-update-right">
                         <i class="fa fa-eye"> </i>
                     </div>
                   <div class="clearfix"> </div>
                 </div>
             </div>
             <div class="col-md-4 market-update-gd">
                 <div class="market-update-block clr-block-3">
                     <div class="col-md-8 market-update-left">
                         <h3>0</h3>
                         <h4>Alert</h4>
                     </div>
                     <div class="col-md-4 market-update-right">
                         <i class="fa fa-envelope-o"> </i>
                     </div>
                   <div class="clearfix"> </div>
                 </div>
             </div>
            <div class="clearfix"> </div>
         </div>
 <!--market updates end here-->
 <!--mainpage chit-chating-->
 <div class="chit-chat-layer1">
     <div class="col-md-6 chit-chat-layer1-left">
                <div class="work-progres">
                             <div class="chit-chat-heading">
                                   Top 10 CPU Utility
                             </div>
                             <div class="table-responsive">
                                 <table class="table table-hover">
                                   <thead>
                                     <tr>
                                       <th>#</th>
                                       <th>Name</th>
                                       <th>Utilization</th>                                   
                                                                         
                                       <th>Status</th>
                                       <th>Progress</th>
                                   </tr>
                               </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Gabriel</td>
                                            <td>37</td>
                                            <td><span class="label label-danger">in progress</span></td>
                                            <td><span class="badge badge-info">50%</span></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Michael</td>
                                            <td>84</td>
                                            <td><span class="label label-success">completed</span></td>
                                            <td><span class="badge badge-success">100%</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Raphael</td>
                                            <td>52</td>
                                            <td><span class="label label-warning">in progress</span></td>
                                            <td><span class="badge badge-warning">75%</span></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Uriel</td>
                                            <td>28</td>
                                            <td><span class="label label-info">in progress</span></td>
                                            <td><span class="badge badge-info">65%</span></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Azrael</td>
                                            <td>91</td>
                                            <td><span class="label label-warning">in progress</span></td>
                                            <td><span class="badge badge-danger">95%</span></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Raguel</td>
                                            <td>67</td>
                                            <td><span class="label label-info">in progress</span></td>
                                            <td><span class="badge badge-success">95%</span></td>
                                        </tr>
                                    </tbody>
                       </table>
                   </div>
              </div>
       </div>
       <div class="col-md-6 chit-chat-layer1-rit">    	
             <div class="geo-chart">
                     <section id="charts1" class="charts">
                 <div class="wrapper-flex">
                    <div class="chit-chat-heading">
                        Top 10 Query
                   </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Query</th>
                                <th>Status</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>1</td>
                              <td>Face book</td>
                              <td>Malorum</td>                                 
                                                         
                              <td><span class="label label-danger">in progress</span></td>
                              <td><span class="badge badge-info">50%</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Twitter</td>
                                <td>Evan</td>                               
                                                                
                                <td><span class="label label-success">completed</span></td>
                                <td><span class="badge badge-success">100%</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Google</td>
                                <td>John</td>                                
                                
                                <td><span class="label label-warning">in progress</span></td>
                                <td><span class="badge badge-warning">75%</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>LinkedIn</td>
                                <td>Danial</td>                                 
                                                            
                                <td><span class="label label-info">in progress</span></td>
                                <td><span class="badge badge-info">65%</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Tumblr</td>
                                <td>David</td>                                
                                                                
                                <td><span class="label label-warning">in progress</span></td>
                                <td><span class="badge badge-danger">95%</span></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Tesla</td>
                                <td>Mickey</td>                                  
                                                            
                                <td><span class="label label-info">in progress</span></td>
                                <td><span class="badge badge-success">95%</span></td>
                            </tr>
                        </tbody>
                    </table>
                 </div><!-- .wrapper-flex -->
                 </section>				
             </div>
       </div>
      <div class="clearfix"> </div>
 </div>
 <!--main page chit chating end here-->
 </div>
 <!--inner block end here-->
 </div>
 </div>
 <!--slider menu-->
     <div class="sidebar-menu">
               <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
                   <!--<img id="logo" src="" alt="Logo"/>--> 
               </a> </div>		  
             <div class="menu">
               <ul id="menu" >
                 <li id="menu-home" ><a href="index.html"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                 <li><a href="#"><i class="fa fa-cogs"></i><span>Components</span><span class="fa fa-angle-right" style="float: right"></span></a>
                   <ul>
                     <li><a href="grids.html">Grids</a></li>
                     <li><a href="portlet.html">Portlets</a></li>		            
                   </ul>
                 </li>
                 <li id="menu-comunicacao" ><a href="#"><i class="fa fa-book nav_icon"></i><span>Element</span><span class="fa fa-angle-right" style="float: right"></span></a>
                   <ul id="menu-comunicacao-sub" >
                     <li id="menu-mensagens" style="width: 120px" ><a href="buttons.html">Buttons</a>		              
                     </li>
                     <li id="menu-arquivos" ><a href="typography.html">Typography</a></li>
                     <li id="menu-arquivos" ><a href="icons.html">Icons</a></li>
                   </ul>
                 </li>
                   <li><a href="maps.html"><i class="fa fa-map-marker"></i><span>Maps</span></a></li>
                 <li id="menu-academico" ><a href="#"><i class="fa fa-file-text"></i><span>Pages</span><span class="fa fa-angle-right" style="float: right"></span></a>
                   <ul id="menu-academico-sub" >
                        <li id="menu-academico-boletim" ><a href="login.html">Login</a></li>
                     <li id="menu-academico-avaliacoes" ><a href="signup.html">Sign Up</a></li>		           
                   </ul>
                 </li>
                 
                 <li><a href="charts.html"><i class="fa fa-bar-chart"></i><span>Charts</span></a></li>
                 <li><a href="#"><i class="fa fa-envelope"></i><span>Mailbox</span><span class="fa fa-angle-right" style="float: right"></span></a>
                      <ul id="menu-academico-sub" >
                         <li id="menu-academico-avaliacoes" ><a href="inbox.html">Inbox</a></li>
                         <li id="menu-academico-boletim" ><a href="inbox-details.html">Compose email</a></li>
                      </ul>
                 </li>
                  <li><a href="#"><i class="fa fa-cog"></i><span>System</span><span class="fa fa-angle-right" style="float: right"></span></a>
                       <ul id="menu-academico-sub" >
                         <li id="menu-academico-avaliacoes" ><a href="404.html">404</a></li>
                         <li id="menu-academico-boletim" ><a href="blank.html">Blank</a></li>
                      </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-shopping-cart"></i><span>E-Commerce</span><span class="fa fa-angle-right" style="float: right"></span></a>
                      <ul id="menu-academico-sub" >
                         <li id="menu-academico-avaliacoes" ><a href="product.html">Product</a></li>
                         <li id="menu-academico-boletim" ><a href="price.html">Price</a></li>
                      </ul>
                  </li>
               </ul>
             </div>
      </div>
     <div class="clearfix"> </div>
 </div>
 <!--slide bar menu end here-->
 <script>
 var toggle = true;
             
 $(".sidebar-icon").click(function() {                
   if (toggle)
   {
     $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
     $("#menu span").css({"position":"absolute"});
   }
   else
   {
     $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
     setTimeout(function() {
       $("#menu span").css({"position":"relative"});
     }, 400);
   }               
                 toggle = !toggle;
             });
 </script>
 <!--scrolling js-->
         <script src="js/jquery.nicescroll.js"></script>
         <script src="js/scripts.js"></script>
         <!--//scrolling js-->
 <script src="js/bootstrap.js"> </script>
 <!-- mother grid end here-->
@endsection
