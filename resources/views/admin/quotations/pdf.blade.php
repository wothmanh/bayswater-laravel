<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote - {{ now()->format('Y-m-d') }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #003366;
            padding-bottom: 20px;
        }
        .logo {
            max-width: 200px;
            height: auto;
        }
        .quote-info {
            text-align: right;
        }
        .quote-date {
            font-size: 14px;
            color: #666;
        }
        .quote-number {
            font-size: 18px;
            font-weight: bold;
            color: #003366;
        }
        .section-title {
            background-color: #003366;
            color: white;
            padding: 10px 15px;
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .item-name {
            flex: 2;
        }
        .item-price {
            flex: 1;
            text-align: right;
            font-weight: bold;
        }
        .item-details {
            font-size: 12px;
            color: #555;
            margin-bottom: 15px;
            padding-left: 10px;
        }
        .subtotal {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            font-weight: bold;
            border-top: 1px solid #ccc;
            margin-top: 15px;
        }
        .total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            font-weight: bold;
            font-size: 20px;
            border-top: 2px solid #003366;
            margin-top: 15px;
            color: #003366;
        }
        .discount {
            color: #28a745;
        }
        .notes {
            margin-bottom: 20px;
        }
        .notes ul {
            margin: 0;
            padding-left: 20px;
        }
        .notes li {
            margin-bottom: 5px;
            color: #555;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .terms {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                @if($settings && $settings->logo_path)
                    <img src="{{ public_path($settings->logo_path) }}" alt="Bayswater Logo" class="logo">
                @else
                    <h1 style="color: #003366;">Bayswater Education</h1>
                @endif
            </div>
            <div class="quote-info">
                <div class="quote-date">Date: {{ now()->format('d M Y, H:i') }}</div>
                <div class="quote-number">Quote #{{ time() }}</div>
            </div>
        </div>

        <h2>Your Quote</h2>

        <!-- Course Section -->
        <div class="section-title">Course</div>
        @php
            $courseTuition = 0;
            $courseName = '';
            foreach ($costBreakdown['items'] as $item) {
                if ($item['category'] === 'tuition') {
                    $courseTuition = $item['amount'];
                    $courseName = $item['name'];
                    break;
                }
            }
        @endphp
        <div class="item">
            <div class="item-name">{{ $courseName }}</div>
            <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($courseTuition, 2) }}</div>
        </div>
        <div class="item-details">
            {{ $costBreakdown['school_name'] }}, {{ $costBreakdown['city_name'] }} - {{ $costBreakdown['course_duration_weeks'] }} weeks<br>
            <strong>Start date:</strong> {{ \Carbon\Carbon::parse($costBreakdown['course_start_date'])->format('d M Y') }}
        </div>

        <!-- Accommodation Section -->
        @php
            $accommodationTotal = $costBreakdown['subtotals']['accommodation'] ?? 0;
            $accommodationName = '';
            foreach ($costBreakdown['items'] as $item) {
                if ($item['category'] === 'accommodation' && !str_contains($item['name'], 'Fee')) {
                    $accommodationName = $item['name'];
                    break;
                }
            }
        @endphp
        @if($accommodationTotal > 0)
        <div class="section-title">Accommodation</div>
        <div class="item">
            <div class="item-name">{{ $accommodationName }}</div>
            <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($accommodationTotal, 2) }}</div>
        </div>
        @endif

        <!-- Optional Extras Section -->
        @php
            $feesTotal = $costBreakdown['subtotals']['fees'] ?? 0;
            $addonsTotal = $costBreakdown['subtotals']['addons'] ?? 0;
        @endphp
        @if($feesTotal > 0 || $addonsTotal > 0)
        <div class="section-title">Optional Extras</div>
        @foreach ($costBreakdown['items'] as $item)
            @if($item['category'] === 'fees' || $item['category'] === 'addons')
            <div class="item">
                <div class="item-name">{{ $item['name'] }}</div>
                <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($item['amount'], 2) }}</div>
            </div>
            @endif
        @endforeach
        <div class="subtotal">
            <div>Extras Subtotal</div>
            <div>{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($costBreakdown['subtotals']['fees'] + $costBreakdown['subtotals']['addons'], 2) }}</div>
        </div>
        @endif

        <!-- Discounts Section -->
        @if (!empty($costBreakdown['discounts']))
        <div class="section-title">Discounts</div>
        @foreach ($costBreakdown['discounts'] as $discount)
        <div class="item discount">
            <div class="item-name">{{ $discount['name'] }}</div>
            <div class="item-price">-{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($discount['amount'], 2) }}</div>
        </div>
        @endforeach
        @endif

        <!-- Notes Section -->
        @if (!empty($costBreakdown['notes']))
        <div class="section-title">Notes</div>
        <div class="notes">
            <ul>
                @foreach ($costBreakdown['notes'] as $note)
                <li>{{ $note }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Total Section -->
        <div class="total">
            <div>Total</div>
            <div>{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($costBreakdown['total'], 2) }}</div>
        </div>

        <div class="terms">
            <p><strong>Terms and Conditions:</strong></p>
            <p>This quote is valid for 30 days from the date of issue. Prices are subject to change without notice. All fees are payable in advance.</p>
            <p>For full terms and conditions, please visit our website or contact our admissions team.</p>
        </div>

        <div class="footer">
            <p>Bayswater Education | Email: info@bayswater.ac | Phone: +44 (0)20 7221 7259</p>
            <p>© {{ date('Y') }} Bayswater Education. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
