@extends('master')

@push('styles')

    <!-- CSS + Animation (নিয়ন + ওয়েভ) -->
    <style>
        .neon-header {
            border-radius: 16px;
            overflow: hidden;
        }
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            animation: wave 12s infinite linear;
        }
        @keyframes wave {
            0% { transform: translateX(0) translateZ(0) scaleY(1); }
            50% { transform: translateX(-25%) translateZ(0) scaleY(0.55); }
            100% { transform: translateX(-50%) translateZ(0) scaleY(1); }
        }
        .wave-path {
            animation: progressiveWave 8s infinite ease-in-out;
        }
        @keyframes progressiveWave {
            0%, 100% { d: path("M0,0V46.29c47.79,22.2,103.59,32.17,158,28,..."); }
            50% { d: path("M0,0V60c60,30,120,40,180,35,..."); } /* অ্যানিমেটেড path */
        }
        .neon-card {
            background: rgba(20, 20, 40, 0.7);
            border: 1px solid rgba(0, 255, 255, 0.15);
            border-radius: 12px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 32px rgba(0, 255, 255, 0.1);
        }
        .neon-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 60px rgba(0, 255, 255, 0.35);
        }
        .neon-title, .neon-value {
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
        }
        .glow-btn {
            background: linear-gradient(45deg, #00f0ff, #ff00aa);
            border: none;
            box-shadow: 0 0 20px rgba(0, 240, 255, 0.6);
            transition: all 0.4s;
        }
        .glow-btn:hover {
            box-shadow: 0 0 40px rgba(0, 240, 255, 0.9);
            transform: scale(1.05);
        }
        .neon-icon { text-shadow: 0 0 12px currentColor; }
    </style>

@endpush
@section('content')
    <!-- নিয়ন ওয়েভ + গ্লো ব্যাকগ্রাউন্ড সহ হেডার -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card neon-header overflow-hidden position-relative"
                 style="background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                        box-shadow: 0 0 40px rgba(0, 255, 255, 0.4);">

                <!-- প্রগতিশীল ওয়েভ SVG + Animation -->
                <svg class="wave" preserveAspectRatio="none" viewBox="0 0 1200 120">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6.15,69.85-17.84,104.45-29.34C989.49,25,1111.1,7.44,1200,29.89V0Z"
                          fill="rgba(0, 255, 255, 0.15)"
                          class="wave-path"></path>
                </svg>

                <div class="card-body text-center position-relative z-2 py-5">
                    <h3 class="text-white mb-2 neon-text">স্বাগতম, {{ auth()->user()->name }}!</h3>
                    <p class="text-white-50 mb-4 neon-subtext">আজকের বই বিক্রির সারসংক্ষেপ দেখুন</p>
                    <a href="{{ route('admin.books.create') }}"
                       class="btn btn-neon glow-btn btn-rounded btn-lg">
                        নতুন বই যোগ করুন
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- টপ কার্ডস (নিয়ন গ্লো সহ) -->
    <div class="row">
        @foreach([
            ['title' => 'আজকের অর্ডার', 'value' => $todayOrders ?? 0, 'change' => '+0%', 'icon' => 'mdi-cart', 'color' => 'cyan'],
            ['title' => 'আজকের সেলস', 'value' => number_format($todaySales ?? 0) . ' ৳', 'icon' => 'mdi-currency-bdt', 'color' => 'magenta'],
            ['title' => 'স্টকে থাকা বই', 'value' => $totalBooksInStock ?? 0, 'icon' => 'mdi-book-open-page-variant', 'color' => 'lime'],
            ['title' => 'লো স্টক আইটেম', 'value' => $lowStockCount ?? 0, 'icon' => 'mdi-alert-circle', 'color' => 'red']
        ] as $card)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card neon-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title neon-title">{{ $card['title'] }}</h6>
                            <i class="mdi {{ $card['icon'] }} neon-icon {{ $card['color'] }}"></i>
                        </div>
                        <h3 class="mb-0 neon-value">{{ $card['value'] }}</h3>
                        @if(isset($card['change']))
                            <p class="text-success mb-0 neon-change">{{ $card['change'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- চার্ট + টপ বই (নিয়ন স্টাইলে) -->
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card neon-card">
                <div class="card-body">
                    <h4 class="card-title neon-title">সাপ্তাহিক সেলস ট্রেন্ড</h4>
                    <canvas id="salesTrendChart" style="height: 280px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card neon-card">
                <div class="card-body">
                    <h4 class="card-title neon-title">টপ সেলিং বই (এই মাসে)</h4>
                    <ul class="list-unstyled neon-list">
                        @foreach($topSellingBooks ?? [] as $book)
                            <li class="py-3 border-bottom neon-item">
                                <strong>{{ $book->title }}</strong><br>
                                <small class="neon-sub">বিক্রি: {{ $book->sales_count }} টি</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Chart.js (নিয়ন কালার সহ) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহস্পতি', 'শুক্র'],
                datasets: [{
                    label: 'সেলস (৳)',
                    data: [{{ implode(',', $weeklySales ?? [0,0,0,0,0,0,0]) }}],
                    borderColor: '#00f0ff',
                    backgroundColor: 'rgba(0, 240, 255, 0.25)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: '#ff00aa',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 8,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { labels: { color: '#ddd' } } },
                scales: {
                    x: { grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#aaa' } },
                    y: { grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#aaa' } }
                }
            }
        });
    </script>
@endpush
