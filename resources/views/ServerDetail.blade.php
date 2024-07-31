@extends('main')

@section('title', $data['name'])

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
                <div class="logo-name-serverDetail">
                    <a href="/prolimslog/dashboard"><h4>Dashboard</h4></a>
                    <h3>{{ $data['name'] }}</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="header-right">
                <div class="last-backup">
                    @php
                        $lastBackupDate = $backup->sortByDesc('last_db_backup_date')->first()->last_db_backup_date ?? 'Not available';
                    @endphp
                    <h3 align="center">LAST BACKUP</h3>
                    <h3 align="center">{{ $lastBackupDate == 'Not available' ? $lastBackupDate : date_format(date_create($lastBackupDate), "H:i:s d-m-y") }}</h3>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--header end here-->
        <!--inner block start here-->
        <div class="inner-block">
            <!--market updates updates-->
            <div class="market-updates">
                <div class="col-md-4 market-update-gd">
                    @if ($data['cpu_utilization'] < 60)
                        <div class="market-update-block clr-block-cpu-normal">
                    @elseif ($data['cpu_utilization'] < 80)
                        <div class="market-update-block clr-block-cpu-warning">
                    @else
                        <div class="market-update-block clr-block-cpu-danger">
                    @endif
                        <div class="col-md-8 market-update-left">
                            <h4>CPU | {{ $data['cpu_utilization'] }}%</h4>
                            <h6>SQL Server :<br>{{ $data['cpu_sql_util'] }}%</h6>
                            <h6>Other :<br>{{ $data['cpu_utilization'] - $data['cpu_sql_util'] }}%</h6>
                        </div>
                        <div class="col-md-4 market-update-right">
                            <i class="fas fa-microchip 
                                @if ($data['cpu_utilization'] < 60)
                                    normal
                                @elseif ($data['cpu_utilization'] < 80)
                                    warning
                                @else
                                    danger
                                @endif
                            "> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 market-update-gd">
                    @if ($data['memory_utilization'] < 60)
                        <div class="market-update-block clr-block-memory-normal">
                    @elseif ($data['memory_utilization'] < 80)
                        <div class="market-update-block clr-block-memory-warning">
                    @else
                        <div class="market-update-block clr-block-memory-danger">
                    @endif
                        <div class="col-md-8 market-update-left">
                            <h4>RAM | {{ $data['memory_utilization'] }}%</h4>
                            <h6>Total Memory:<br>{{ $data['total_memory_mb'] }} MB</h6>
                            <h6>Used Memory:<br>{{ $data['memory_in_use_mb'] }} MB</h6>
                        </div>
                        <div class="col-md-4 market-update-right">
                            <i class="fas fa-memory 
                                @if ($data['memory_utilization'] < 60)
                                    normal
                                @elseif ($data['memory_utilization'] < 80)
                                    warning
                                @else
                                    danger
                                @endif
                            "> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 market-update-gd">
                    @if ($data['disk_utilization'] < 60)
                        <div class="market-update-block clr-block-disk-normal">
                    @elseif ($data['disk_utilization'] < 80)
                        <div class="market-update-block clr-block-disk-warning">
                    @else
                        <div class="market-update-block clr-block-disk-danger">
                    @endif
                        <div class="col-md-8 market-update-left">
                            <h4>Disk | {{ $data['disk_utilization'] }}%</h4>
                            <h6>Total Disk :<br>{{ round($data['disk_size'] / 1024, 2) }} GB</h6>
                            <h6>Used Disk :<br>{{ round($data['data_size'] / 1024, 2) }} GB</h6>
                        </div>
                        <div class="col-md-4 market-update-right">
                            <i class="fas fa-hard-drive 
                                @if ($data['disk_utilization'] < 60)
                                    normal
                                @elseif ($data['disk_utilization'] < 80)
                                    warning
                                @else
                                    danger
                                @endif
                            "> </i>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--market updates end here-->
            <!--mainpage chit-chatting-->
            <div class="chit-chat-layer1">
                {{-- tabel Query --}}
                <div class="col-md-6 chit-chat-layer-left">
                    <div class="work-progres">
                        <div class="table-responsive">
                            <table class="table table-hover" id="serverQuerries">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Query</th>
                                        <th>Count</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($queries as $query)
                                    <tr>
                                        <td>{{ $query->no }}</td>
                                        <td>
                                            <button type="button" class="reset-button" data-toggle="modal" data-target="#id-{{ $query->no }}" onclick="openPop(`{{ addslashes($query->query) }}`)">
                                                <span class="truncate" title="{{ $query->query }}" data-full-text="{{ $query->query }}">{{ $query->query }}</span>
                                            </button>
                                        </td>
                                        <td>{{ $query->count }}</td>
                                        <td>{{ $query->last_query }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Popup Dialog -->
                            <div id="popupDialog" style="visibility:hidden; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: rgb(255, 255, 255); border: 1px solid black; padding: 10px 10px 0px 10px; z-index: 1000; max-height: 70vh; overflow-y: auto;">
                                <div id="popupContent" style="overflow-y: auto;">
                                    <p id="popupQuery"></p>
                                </div>
                                <div id="popupFooter" style="position: sticky; bottom: 0px; background-color: white; padding: 10px;">
                                    <button onclick="closePop()">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    var identifier = "{{ $identifier }}";
                
                    // Function to open the popup dialog with the full query text
                    function openPop(query) {
                        const popDialog = document.getElementById("popupDialog");
                        const popupQuery = document.getElementById("popupQuery");
                        popupQuery.textContent = query;
                        popDialog.style.visibility = "visible";
                    }
                
                    // Function to close the popup dialog
                    function closePop() {
                        const popDialog = document.getElementById("popupDialog");
                        popDialog.style.visibility = "hidden";
                    }
                
                    $(document).ready(function() {
                        // Function to slice long query texts in the DataTable
                        function sliceText() {
                            $('.truncate').each(function() {
                                var fullText = $(this).data('full-text');
                                var maxLength = 25; // Adjust the length as needed
                                if (fullText.length > maxLength) {
                                    var slicedText = fullText.slice(0, maxLength) + '...';
                                    $(this).text(slicedText);
                                }
                            });
                        }
                
                        // Initialize DataTable
                        var table = $('#serverQuerries').DataTable({
                            autoWidth: false,  // Ensure automatic width calculation is disabled
                            columnDefs: [
                                { width: '1%', targets: 0 },  // Adjusted width
                                { width: '5%', targets: 1 },  // Adjusted width
                                { width: '3%', targets: 2 },  // Adjusted width
                                { width: '60%', targets: 3 }   // Adjusted width
                            ],
                            paging: false,
                            drawCallback: function() {
                                sliceText();
                                // Rebind click events for new buttons
                                $('.reset-button').off('click').on('click', function() {
                                    var query = $(this).find('.truncate').data('full-text');
                                    openPop(query);
                                });
                            }
                        });
                
                        function fetchAndUpdateTable() {
                            $.ajax({
                                url: `prolimslog/indexServerDetail/${identifier}`,
                                method: 'GET',
                                success: function(data) {
                                    data = data.queries;
                                    table.clear();
                                    data.forEach(function(item, index) {
                                        var queryText = item.query.length > 25 ? item.query.slice(0, 25) + '...' : item.query;
                                        var newRow = $(`
                                            <tr>
                                                <td>${index + 1}</td>
                                                <td>
                                                    <button type="button" class="reset-button" data-toggle="modal" data-target="#id-${index + 1}" onclick="openPop('${item.query.replace(/'/g, "\\'")}')">
                                                        <span class="truncate" title="${item.query}" data-full-text="${item.query}">${queryText}</span>
                                                    </button>
                                                </td>
                                                <td>${item.count}</td>
                                                <td>${item.last_query}</td>
                                            </tr>`);
                                        table.row.add(newRow).draw(false);
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error fetching data:', error);
                                }
                            });
                        }
                
                        // Set interval to fetch and update the table every 5 seconds
                        setInterval(fetchAndUpdateTable, 5000);
                    });
                </script>                                                                                             
                {{-- endof tabel Query --}}
                {{-- Backup --}}
                <div class="col-md-6 chit-chat-layer-rit">
                    <div class="work-progres">
                        <div class="table-responsive">
                            <table class="table table-hover" id="backupinfo">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Last Backup</th>
                                        <th>Backup Start</th>
                                        <th>Size (GB)</th>
                                        <th>Path</th>
                                        <th>name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($backup as $item)
                                    <tr>
                                        <td>{{ $item->no }}</td>
                                        <td>{{ $item->last_db_backup_date }}</td>
                                        <td>{{ $item->backup_start_date }}</td>
                                        <td>{{ round($item->backup_size/1024,2)  }}</td>
                                        <td>{{ $item->physical_device_name }}</td>
                                        <td>{{ $item->backupset_name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {
                                    var tabelHospital = $('#backupinfo').DataTable({
                                        autoWidth: false,  // Ensure automatic width calculation is disabled
                                        columnDefs: [
                                            { width: '2%', targets: 0 },  // Adjusted width
                                            { width: '13%', targets: 1 },  // Adjusted width
                                            { width: '13%', targets: 2 },  // Adjusted width
                                            { width: '7%', targets: 3 },  // Adjusted width
                                            { width: '25%', targets: 4 },  // Adjusted width
                                            { width: '20%', targets: 5 }   // Adjusted width
                                        ],
                                        paging: false
                                    });

                                    function fetchAndUpdateBackup() {
                                        $.ajax({
                                            url: `prolimslog/indexServerDetail/${identifier}`,
                                            method: 'GET',
                                            success: function(data) {
                                                data = data.backup;
                                                console.log(data);
                                                tabelHospital.clear();
                                                data.forEach(function(item, index) {
                                                    var newRow = $(`
                                                        <tr>
                                                            <td>${index + 1}</td>
                                                            <td>${item.last_db_backup_date}</td>
                                                            <td>${item.backup_start_date}</td>
                                                            <td>${Math.round(item.backup_size/1024)}</td>
                                                            <td id ="pathdata">${item.physical_device_name}</td>
                                                            <td>${item.backupset_name}</td>
                                                        </tr>`);
                                                    tabelHospital.row.add(newRow).draw(false);
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error fetching data:', error);
                                            }
                                        });
                                    }
                                    setInterval(fetchAndUpdateBackup, 1000);
                                });
                            </script>                                
                        </div>
                    </div>
                </div>
                {{-- endof backup --}}
                <div class="clearfix"> </div>
            </div>
            {{-- modal --}}
            <!--main page chit chatting end here-->
        </div>
        <!--inner block end here-->
    </div>
    <div class="clearfix"> </div>
</div>
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
@endsection