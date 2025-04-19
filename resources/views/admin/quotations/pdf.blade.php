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
        .subsection-title {
            font-weight: bold;
            font-size: 14px;
            color: #003366;
            margin-top: 10px;
            margin-bottom: 5px;
            padding-left: 10px;
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

        <!-- Courses Section -->
        <div class="section-title">Courses</div>

        @if(!empty($costBreakdown['courses']))
            @foreach($costBreakdown['courses'] as $index => $course)
                <div class="item">
                    <div class="item-name">{{ $course['course_name'] }}</div>
                    <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($course['fee'], 2) }}</div>
                </div>
                <div class="item-details">
                    {{ $costBreakdown['school_name'] }}, {{ $costBreakdown['city_name'] }} - {{ $course['duration_weeks'] }} weeks<br>
                    <strong>Start date:</strong> {{ \Carbon\Carbon::parse($course['start_date'])->format('d M Y') }}<br>
                    <strong>End date:</strong> {{ \Carbon\Carbon::parse($course['end_date'])->format('d M Y') }}
                </div>
            @endforeach
            <div class="subtotal">
                <div>Course Subtotal</div>
                <div>{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($costBreakdown['subtotals']['tuition'], 2) }}</div>
            </div>
        @else
            @php
                $courseItems = [];
                foreach ($costBreakdown['items'] as $item) {
                    if ($item['category'] === 'tuition') {
                        $courseItems[] = $item;
                    }
                }
            @endphp

            @if(count($courseItems) > 0)
                @foreach($courseItems as $index => $courseItem)
                    <div class="item">
                        <div class="item-name">{{ $courseItem['name'] }}</div>
                        <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($courseItem['amount'], 2) }}</div>
                    </div>
                    <div class="item-details">
                        {{ $costBreakdown['school_name'] }}, {{ $costBreakdown['city_name'] }}
                        @if(isset($costBreakdown['course_start_date']))
                            - {{ $costBreakdown['course_duration_weeks'] ?? 'N/A' }} weeks<br>
                            <strong>Start date:</strong> {{ \Carbon\Carbon::parse($costBreakdown['course_start_date'])->format('d M Y') }}<br>
                            <strong>End date:</strong> {{ isset($costBreakdown['course_end_date']) ? \Carbon\Carbon::parse($costBreakdown['course_end_date'])->format('d M Y') : 'N/A' }}
                        @else
                            - Duration: N/A<br>
                            <strong>Start date:</strong> N/A<br>
                            <strong>End date:</strong> N/A
                        @endif
                    </div>
                @endforeach
                <div class="subtotal">
                    <div>Course Subtotal</div>
                    <div>{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($costBreakdown['subtotals']['tuition'], 2) }}</div>
                </div>
            @else
                <div class="item">
                    <div class="item-name">No course selected</div>
                    <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}0.00</div>
                </div>
            @endif
        @endif

        <!-- Accommodation Section -->
        @php
            $accommodationTotal = $costBreakdown['subtotals']['accommodation'] ?? 0;
        @endphp
        @if($accommodationTotal > 0)
        <div class="section-title">Accommodation</div>

        @if(!empty($costBreakdown['accommodations']))
            @foreach($costBreakdown['accommodations'] as $index => $accommodation)
                <div class="item">
                    <div class="item-name">{{ $accommodation['accommodation_name'] }}</div>
                    <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($accommodation['fee'], 2) }}</div>
                </div>
                <div class="item-details">
                    <strong>Duration:</strong> {{ $accommodation['duration_weeks'] }} weeks
                </div>
            @endforeach
        @else
            @php
                $accommodationItems = [];
                foreach ($costBreakdown['items'] as $item) {
                    if ($item['category'] === 'accommodation' && !str_contains($item['name'], 'Fee')) {
                        $accommodationItems[] = $item;
                    }
                }
            @endphp
            @foreach($accommodationItems as $index => $accommodationItem)
                <div class="item">
                    <div class="item-name">{{ $accommodationItem['name'] }}</div>
                    <div class="item-price">{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($accommodationItem['amount'], 2) }}</div>
                </div>
                <div class="item-details">
                    @if(isset($costBreakdown['accommodation_duration_weeks']))
                        <strong>Duration:</strong> {{ $costBreakdown['accommodation_duration_weeks'] }} weeks
                    @else
                        <strong>Duration:</strong> N/A weeks
                    @endif
                </div>
            @endforeach
        @endif

        <div class="subtotal">
            <div>Accommodation Subtotal</div>
            <div>{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($costBreakdown['subtotals']['accommodation'], 2) }}</div>
        </div>
        @endif

        <!-- Course + Accommodation Subtotal -->
        @php
            $courseAccommodationTotal = ($costBreakdown['subtotals']['tuition'] ?? 0) + ($costBreakdown['subtotals']['accommodation'] ?? 0);
        @endphp
        @if($courseAccommodationTotal > 0)
        <div class="subtotal" style="border-top: 2px solid #003366; margin-top: 20px;">
            <div>Sub Total</div>
            <div>{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($courseAccommodationTotal, 2) }}</div>
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
        <div class="section-title">Discounts Applied</div>

        @php
            $courseDiscounts = [];
            $accommodationDiscounts = [];
            $otherDiscounts = [];

            foreach ($costBreakdown['discounts'] as $discount) {
                if ($discount['amount'] > 0) {
                    if ($discount['applied_to'] === 'course_tuition') {
                        $courseDiscounts[] = $discount;
                    } elseif ($discount['applied_to'] === 'accommodation_price') {
                        $accommodationDiscounts[] = $discount;
                    } else {
                        $otherDiscounts[] = $discount;
                    }
                }
            }
        @endphp

        @if(count($courseDiscounts) > 0)
            <div class="subsection-title">Course Discounts:</div>
            @foreach($courseDiscounts as $discount)
                <div class="item discount">
                    <div class="item-name">{{ $discount['name'] }}</div>
                    <div class="item-price">-{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($discount['amount'], 2) }}</div>
                </div>
            @endforeach
        @endif

        @if(count($accommodationDiscounts) > 0)
            <div class="subsection-title">Accommodation Discounts:</div>
            @foreach($accommodationDiscounts as $discount)
                <div class="item discount">
                    <div class="item-name">{{ $discount['name'] }}</div>
                    <div class="item-price">-{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($discount['amount'], 2) }}</div>
                </div>
            @endforeach
        @endif

        @if(count($otherDiscounts) > 0)
            <div class="subsection-title">Other Discounts:</div>
            @foreach($otherDiscounts as $discount)
                <div class="item discount">
                    <div class="item-name">{{ $discount['name'] }}</div>
                    <div class="item-price">-{{ $costBreakdown['currency_symbol'] ?? '' }}{{ number_format($discount['amount'], 2) }}</div>
                </div>
            @endforeach
        @endif
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
