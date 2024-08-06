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
                    <a href="/prolimslog/dashboard"> <h1>ELIMSPRO</h1> 
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
            <!--Status Rumah Sakit-->
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
            <!--Status Rumah Sakit end here-->
            <!--mainpage dashboard-->
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
                                    <tr data-href="/prolimslog/server-detail/{{ $data->id }}">
                                        <td>{{ $data->id }}</td>
                                        <td class = "hospitalname">{{ $data->name }}</td>
                                        <td @if ($data->cpu_utilization>80) style = "font-weight : 900; color: #E41717" @endif>{{ $data->cpu_utilization }}%</td>
                                        <td @if ($data->memory_utilization>80) style = "font-weight : 900; color: #E41717" @endif>{{ $data->memory_utilization }}%</td>
                                        <td @if ($data->disk_utilization>80) style = "font-weight : 900; color: #E41717" @endif>{{ $data->disk_utilization }}%</td>
                                        <td>{{ $data->last_db_backup_date }}</td>
                                        <td>
                                            @if (max($data->cpu_utilization, $data->memory_utilization, $data->disk_utilization) < 60)
                                                <span class="label label-success">normal</span>
                                            @elseif (max($data->cpu_utilization, $data->memory_utilization, $data->disk_utilization) < 80)
                                                <span class="label label-warning">warning</span>
                                            @elseif (max($data->cpu_utilization, $data->memory_utilization, $data->disk_utilization) >= 80)
                                                <span class="label label-danger">danger</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {
                                    // Detect custom status type
                                    $.fn.dataTable.ext.type.detect.unshift(function(d) {
                                        return d === 'normal' || d === 'warning' || d === 'danger' ? 'status' : null;
                                    });
                
                                    // Define custom sorting for status type
                                    $.fn.dataTable.ext.type.order['status-pre'] = function(d) {
                                        var v = $(d).text();
                                        switch (v) {
                                            case 'normal': return 1;
                                            case 'warning': return 2;
                                            case 'danger': return 3;
                                        }
                                        return 4;
                                    };
                
                                    function sliceText() {
                                        $('#servercpu tbody tr td:nth-child(2)').each(function() {
                                            var fullText = $(this).text();
                                            var maxLength = 30; // Adjust the length as needed
                                            if (fullText.length > maxLength) {
                                                var slicedText = fullText.slice(0, maxLength) + '...';
                                                $(this).text(slicedText);
                                            }
                                        });
                                    }
                
                                    var tabelHospital = $('#servercpu').DataTable({
                                        order: [[6, 'desc']],
                                        autoWidth: false,
                                        paging: false,
                                        columnDefs: [
                                            { type: 'status', targets: 6, className: 'dt-center' }
                                        ],
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
                
                                            // Call the sliceText function after drawing the table
                                            sliceText();
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
                                            url: '/prolimslog/index',
                                            method: 'GET',
                                            success: function(data) {
                                                console.log('Data fetched:', data);
                                                tabelHospital.clear();
                                                var normalCount = 0;
                                                var warningCount = 0;
                                                var dangerCount = 0;
                                                var no = 1;
                
                                                data.forEach(function(item) {
                                                    var statusLabel = 'normal';
                                                    var statusClass = 'label-success';
                                                    var maxUtilization = Math.max(item.cpu_utilization, item.memory_utilization, item.disk_utilization);
                                                    item.memory_utilization = parseFloat(item.memory_utilization).toFixed(2);
                                                    item.disk_utilization = parseFloat(item.disk_utilization).toFixed(2);
                                                    if (maxUtilization >= 80 || !isToday(item.last_db_backup_date)) {
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
                                                    var newRow = $(`<tr data-href="/prolimslog/server-detail/${item.id}">
                                                        <td>${no++}</td>
                                                        <td class = "hospitalname">${item.name}</td>
                                                        <td ${item.cpu_utilization>80?'style = "font-weight : 900; color: #E41717"':''}>${item.cpu_utilization}%</td>
                                                        <td ${item.memory_utilization>80?'style = "font-weight : 900; color: #E41717"':''}>${item.memory_utilization}%</td>
                                                        <td ${item.disk_utilization>80?'style = "font-weight : 900; color: #E41717"':''}>${item.disk_utilization}%</td>
                                                        <td ${isToday(item.last_db_backup_date)?'':'style = "font-weight : 900; color: #E41717"'}>${item.last_db_backup_date}</td>
                                                        <td><span class="label ${statusClass}">${statusLabel}</span></td>
                                                    </tr>`);
                                                    tabelHospital.row.add(newRow).draw(false);
                                                });
                                                tabelHospital.columns.adjust().draw();
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

                                    function isToday(datetime) {

                                        if (datetime == 'not available') {
                                            return false;
                                        }

                                        const monthMap = {
                                            Jan: 0, Feb: 1, Mar: 2, Apr: 3,
                                            May: 4, Jun: 5, Jul: 6, Aug: 7,
                                            Sep: 8, Oct: 9, Nov: 10, Dec: 11
                                        };

                                        const [day, month, year, time] = datetime.split(' ');

                                        const backupDate = new Date(year, monthMap[month], day);

                                        const today = new Date();
                                        today.setHours(0, 0, 0, 0); // Reset time to midnight

                                        return backupDate.getTime() === today.getTime();
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
                                            var reachedBottom = (scrollPosition + viewHeight) >= scrollHeight + 100;
                                            var reachedTop = scrollPosition <= 0;
                
                                            if (reachedBottom) {
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
            <!--main page dashboard end here-->
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
@endsection