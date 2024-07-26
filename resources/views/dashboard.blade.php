@extends('main')

@section('title', 'Dashboard')

@section('page') 
<div class="page-container">    
    <div class="mother-grid-inner">
        <!--header start here-->
        <div class="header-main">
            <div class="clock">
                <h1>
                    <div id="time"></div>
                    <script type="text/javascript">
                        function showTime() {
                            var date = new Date();
                            let h = date.getHours(); // 0 - 23
                            let m = date.getMinutes(); // 0 - 59
                            let s = date.getSeconds(); // 0 - 59
                            h = h < 10 ? "0" + h : h;
                            m = m < 10 ? "0" + m : m;
                            s = s < 10 ? "0" + s : s;
                            document.getElementById('time').textContent = `${h}:${m}:${s}`;
                        }
                        setInterval(showTime, 1000);
                    </script>
                </h1>
            </div>
            <div class="header-left">
                <div class="logo-name">
                    <a href="/dashboard"> <h1>ELIMSPRO</h1> 
                    <!--<img id="logo" src="" alt="Logo"/>--> 
                    </a>                                
                </div>
                <!--search-box-->
            </div>
            <div class="header-right">
                <div class="search-box">
                    <form>
                        <input type="text" id="searchHospital" placeholder="Search Hospital" required="">    
                        <input type="submit" value="">                    
                    </form>
                </div><!--//end-search-box-->
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Autoscroll</label>
                </div>
                <div class="clearfix"> </div>
            </div>
            <script>
                var scroll_pos = 0;
                var scroll_time;

                $(window).scroll(function() {
                    clearTimeout(scroll_time);
                    var current_scroll = $(window).scrollTop();
                    
                    if (current_scroll >= 200) {
                        $('.market-updates-onScroll').addClass('showing'); 
                    }else{
                        $('.market-updates-onScroll').removeClass('showing');
                    }
                    scroll_time = setTimeout(function() {
                        scroll_pos = $(window).scrollTop();
                    }, 100);
                });
            </script>
            <div class="clearfix"> </div>   
            <div class="market-updates-onScroll">
                <div class="col-md-4 market-update-gd">
                    <div class="market-update-block clr-block-1">
                        <div class="col-md-8 market-update-left">
                            <h3 id="normal-count">{{ $summ['normal'] }}</h3>
                            <h4>Normal</h4>
                        </div>
                        <div class="col-md-4 market-update-right-dashboard">
                            <i class="fa fa-check"> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 market-update-gd">
                    <div class="market-update-block clr-block-2">
                        <div class="col-md-8 market-update-left">
                            <h3 id="warning-count">{{ $summ['warning'] }}</h3>
                            <h4>Warning</h4>
                        </div>
                        <div class="col-md-4 market-update-right-dashboard">
                            <i class="fa fa-exclamation"> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 market-update-gd">
                    <div class="market-update-block clr-block-3">
                        <div class="col-md-8 market-update-left">
                            <h3 id="danger-count">{{ $summ['danger'] }}</h3>
                            <h4>Danger</h4>
                        </div>
                        <div class="col-md-4 market-update-right-dashboard">
                            <i class="fa fa-close"> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!--header end here-->
        <!--inner block start here-->
        <div class="inner-block">
            <!--market updates updates-->
            <div class="market-updates">
                <div class="col-md-4 market-update-gd">
                    <div class="market-update-block clr-block-1">
                        <div class="col-md-8 market-update-left">
                            <h3 id="normal-count">{{ $summ['normal'] }}</h3>
                            <h4>Normal</h4>
                        </div>
                        <div class="col-md-4 market-update-right-dashboard">
                            <i class="fa fa-check"> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 market-update-gd">
                    <div class="market-update-block clr-block-2">
                        <div class="col-md-8 market-update-left">
                            <h3 id="warning-count">{{ $summ['warning'] }}</h3>
                            <h4>Warning</h4>
                        </div>
                        <div class="col-md-4 market-update-right-dashboard">
                            <i class="fa fa-exclamation"> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 market-update-gd">
                    <div class="market-update-block clr-block-3">
                        <div class="col-md-8 market-update-left">
                            <h3 id="danger-count">{{ $summ['danger'] }}</h3>
                            <h4>Danger</h4>
                        </div>
                        <div class="col-md-4 market-update-right-dashboard">
                            <i class="fa fa-close"> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--market updates end here-->
            <!--mainpage chit-chatting-->
            <div class="chit-chat-layer1">
                <div class="col-md-12 chit-chat-layer-full">
                    <div class="work-progres">
                        <div class="table-responsive">
                            <table class="table table-hover" id="servercpu">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hospital</th>
                                        <th>CPU</th>
                                        <th>Memory Usage</th>
                                        <th>Disk Usage</th>
                                        <th>Last DB Backup</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                    <tr data-href="/server-detail/{{ $data->id }}">
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->cpu_utilization }}%</td>
                                        <td>{{ $data->memory_utilization }}%</td>
                                        <td>{{ $data->disk_utilization }}%</td>
                                        <td>{{ $data->last_db_backup_date }}</td>
                                        <td>
                                            @if (max($data->cpu_utilization, $data->memory_utilization, $data->disk_utilization) < 60)
                                                <span class="label label-success">normal</span>
                                            @elseif (max($data->cpu_utilization, $data->memory_utilization, $data->disk_utilization) < 80)
                                                <span class="label label-warning">warning</span>
                                            @else
                                                <span class="label label-danger">danger</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {
                                    var tabelHospital = $('#servercpu').DataTable({   
                                        paging: false,  
                                        initComplete: function(settings, json) {
                                            $('.dt-paging-button').on("focus", function() {
                                                $(this).blur();
                                            });
                                            $('.dt-paging-button').attr("tabindex", "-1");
                                        },
                                        drawCallback: function(settings) {
                                            $('.dt-paging-button').on("focus", function() {
                                                $(this).blur();
                                            });
                                            $('.dt-paging-button').attr("tabindex", "-1");
                                        }
                                    });

                                    $('#searchHospital').keyup(function() {
                                        tabelHospital.search($(this).val()).draw();
                                    });

                                    $('#servercpu').on('click', 'tbody tr', function() {
                                        var href = $(this).data('href');
                                        if (href) {
                                            window.location.href = href;
                                        }
                                    });

                                    function fetchAndUpdateTable() {
                                        var currentScrollPosition = window.scrollY;

                                        $.ajax({
                                            url: '/index',
                                            method: 'GET',
                                            success: function(data) {
                                                tabelHospital.clear();  
                                                var normalCount = 0;
                                                var warningCount = 0;
                                                var dangerCount = 0;

                                                data.forEach(function(item) {
                                                    var statusLabel = 'normal';
                                                    var statusClass = 'label-success';
                                                    var maxUtilization = Math.max(item.cpu_utilization, item.memory_utilization, item.disk_utilization);
                                                    //save the memory utlization to float with precision of 2
                                                    item.memory_utilization = parseFloat(item.memory_utilization).toFixed(2);
                                                    //and disk utilization
                                                    item.disk_utilization = parseFloat(item.disk_utilization).toFixed(2);
                                                    if (maxUtilization >= 80) {
                                                        statusLabel = 'danger';
                                                        statusClass = 'label-danger';
                                                        dangerCount++;
                                                    } else if (maxUtilization >= 60) {
                                                        statusLabel = 'warning';
                                                        statusClass = 'label-warning';
                                                        warningCount++;
                                                    } else {
                                                        normalCount++;
                                                    }
                                                    var newRow = $(`<tr data-href="/server-detail/${item.id}">
                                                        <td>${item.id}</td>
                                                        <td>${item.name}</td>
                                                        <td>${item.cpu_utilization}%</td>
                                                        <td>${item.memory_utilization}%</td>
                                                        <td>${item.disk_utilization}%</td>
                                                        <td>${item.last_db_backup_date}</td>
                                                        <td><span class="label ${statusClass}">${statusLabel}</span></td>
                                                    </tr>`);
                                                    tabelHospital.row.add(newRow).draw(false);
                                                });
                                                window.scrollTo(0, currentScrollPosition);
                                                updateSummary(normalCount, warningCount, dangerCount);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error fetching data:', error);
                                            }
                                        });
                                    }

                                    function updateSummary(normal, warning, danger) {
                                        $('#normal-count').text(normal);
                                        $('#warning-count').text(warning);
                                        $('#danger-count').text(danger);
                                    }

                                    setInterval(fetchAndUpdateTable, 5000);
                                    fetchAndUpdateTable();
                                    
                                    // Auto-scroll logic
                                    var autoScrollInterval;
                                    var scrollSpeed = 6; // Adjust scroll speed
                                    var scrollDirection = 1; // 1 for down, -1 for up

                                    function startAutoScroll() {
                                        autoScrollInterval = setInterval(function() {
                                            var scrollPosition = window.scrollY;
                                            var viewHeight = window.innerHeight;                                           
                                            var scrollHeight = document.body.scrollHeight;                                            
                                            var reachedBottom = (scrollPosition + viewHeight) >= scrollHeight+100;
                                            var reachedTop = scrollPosition <= 0;
                                            
                                            if (reachedBottom) {
                                                console.log(`scrollposition ${scrollPosition} viewHeight ${viewHeight} scrollHeight ${scrollHeight}`);
                                                scrollDirection = -1; // Change direction to up
                                            } else if (reachedTop) {
                                                scrollDirection = 1; // Change direction to down
                                            }
                                            
                                            window.scrollBy(0, scrollSpeed * scrollDirection);
                                        }, 30); // Adjust this value for scroll smoothness
                                    }

                                    function stopAutoScroll() {
                                        clearInterval(autoScrollInterval);
                                    }

                                    // Start auto-scroll on page load
                                    document.getElementById('flexSwitchCheckDefault').addEventListener('change', function() {
                                        if (this.checked) {
                                            startAutoScroll();
                                        } else {
                                            stopAutoScroll();
                                        }
                                    });
                                    if (document.getElementById('flexSwitchCheckDefault').checked) {
                                        startAutoScroll();
                                    }
                                });
                            </script>                                                                                            
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--main page chit chatting end here-->
        </div>
        <!--inner block end here-->
    </div>
    <div class="clearfix"> </div>
</div>
<script>
var toggle = true;
$(".sidebar-icon").click(function() {                
if (toggle) {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
} else {
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
<script src="js/bootstrap.js"> </script>
@endsection