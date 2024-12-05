@extends('layout.master')
@push('css')
@endpush
@section('content')
    <div id="nav" class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    لوحة التحكم
                </li>
                <li class="breadcrumb-item active">
                    الصفحة الرئيسية
                </li>
            </ol>
        </nav>
    </div>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">


                    <div class="d-flex justify-content-between">
                        @if (session('success'))
                            <div id="redirectMSG" class="alert alert-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif
                        <h4 class="card-title mg-b-0"> الصفحة الرئيسية </h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"></p>
                    <br>
                    <div id="nav" style="float: left;">

                        <button onclick="window.print(); return false;" class="btn btn-secondary">
                            طباعة
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                                <path
                                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            </svg></button>
                    </div>
                    <br><br>
                </div>
                <div id="print" class="card-body">
                    <br><br>
                    <h4>احصائيات يومية</h4>
                    <div class="row">
                        @if (isset($dailyBuffaloQuantity))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المستلمة اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyBuffaloQuantity > 0 ? $dailyBuffaloQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($dailyCowQuantity))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المستلمة اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyCowQuantity > 0 ? $dailyCowQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($dailyBuffaloSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المباعة اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyBuffaloSales > 0 ? $dailyBuffaloSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($dailyCowSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المباعة اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyCowSales > 0 ? $dailyCowSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="row">
                        @if (isset($dailyHomeSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مبيعات البيت اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyHomeSales > 0 ? $dailyHomeSales . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($dailyBuffaloDeficiency))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        عجز اللبن الجاموسي اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyBuffaloDeficiency > 0 ? $dailyBuffaloDeficiency . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($dailyCowDeficiency))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        عجز اللبن البقري اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyCowDeficiency > 0 ? $dailyCowDeficiency . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($dailyAdditionalExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        المصاريف الاضافية اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyAdditionalExpenses > 0 ? $dailyAdditionalExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        @if (isset($dailyHomeExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مصاريف البيت اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyHomeExpenses > 0 ? $dailyHomeExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($dailyFarmExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مصاريف المزرعة اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyFarmExpenses > 0 ? $dailyFarmExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($dailyReceiveMoney))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مشتريات اللبن اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailyReceiveMoney > 0 ? $dailyReceiveMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($dailySalesMoney))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مبيعات اللبن اليوم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $dailySalesMoney > 0 ? $dailySalesMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        @if (isset($dailyBuffaloHome))
                        <div class="col-md-3">
                            <div class="card bg-secondary">
                                <div style="font-weight: bold" class="card-header">
                                    كمية اللبن الجاموسي المباع في البيت اليوم
                                </div>
                                <div style="font-weight: bold" class="card-body text-white">
                                    {{ $dailyBuffaloHome > 0 ? $dailyBuffaloHome . 'كيلو' : 'لا يوجد' }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($dailyCowHome))
                    <div class="col-md-3">
                        <div class="card bg-secondary">
                            <div style="font-weight: bold" class="card-header">
                                كمية اللبن البقري المباع في البيت اليوم
                            </div>
                            <div style="font-weight: bold" class="card-body text-white">
                                {{ $dailyCowHome > 0 ? $dailyCowHome . 'كيلو' : 'لا يوجد' }}
                            </div>
                        </div>
                    </div>
                @endif
                    </div>
                    <br><br>
<h4>احصائيات أسبوعية</h4>
                    <div class="row">
                        @if (isset($weeklyBuffaloQuantity))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المستلمة خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyBuffaloQuantity > 0 ? $weeklyBuffaloQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($weeklyCowQuantity))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المستلمة خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyCowQuantity > 0 ? $weeklyCowQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($weeklyBuffaloSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المباعة خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyBuffaloSales > 0 ? $weeklyBuffaloSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($weeklyCowSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المباعة خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyCowSales > 0 ? $weeklyCowSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="row">
                        @if (isset($weeklyHomeSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مبيعات البيت خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyHomeSales > 0 ? $weeklyHomeSales . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($weeklyBuffaloDeficiency))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        عجز اللبن الجاموسي خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyBuffaloDeficiency > 0 ? $weeklyBuffaloDeficiency . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($weeklyCowDeficiency))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        عجز اللبن البقري خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyCowDeficiency > 0 ? $weeklyCowDeficiency . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($weeklyAdditionalExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        المصاريف الاضافية خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyAdditionalExpenses > 0 ? $weeklyAdditionalExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        @if (isset($weeklyHomeExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مصاريف البيت خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyHomeExpenses > 0 ? $weeklyHomeExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($weeklyFarmExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مصاريف المزرعة خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyFarmExpenses > 0 ? $weeklyFarmExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($weeklyReceiveMoney))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مشتريات اللبن خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyReceiveMoney > 0 ? $weeklyReceiveMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($weeklySalesMoney))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مبيعات اللبن خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklySalesMoney > 0 ? $weeklySalesMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        @if (isset($weeklyBuffaloHome))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المباع في البيت خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyBuffaloHome > 0 ? $weeklyBuffaloHome . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (isset($weeklyCowHome))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المباع في البيت خلال الاسبوع
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $weeklyCowHome > 0 ? $weeklyCowHome . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <br><br>
                    <h4>احصائيات شهرية</h4>
                    <div class="row">
                        @if (isset($monthlyBuffaloQuantity))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المستلمة خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyBuffaloQuantity > 0 ? $monthlyBuffaloQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($monthlyCowQuantity))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المستلمة خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyCowQuantity > 0 ? $monthlyCowQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($monthlyBuffaloSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المباعة خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyBuffaloSales > 0 ? $monthlyBuffaloSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($monthlyCowSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المباعة خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyCowSales > 0 ? $monthlyCowSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="row">
                        @if (isset($monthlyHomeSales))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مبيعات البيت خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyHomeSales > 0 ? $monthlyHomeSales . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($monthlyBuffaloDeficiency))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        عجز اللبن الجاموسي خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyBuffaloDeficiency > 0 ? $monthlyBuffaloDeficiency . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($monthlyCowDeficiency))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        عجز اللبن البقري خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyCowDeficiency > 0 ? $monthlyCowDeficiency . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($monthlyAdditionalExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        المصاريف الاضافية خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyAdditionalExpenses > 0 ? $monthlyAdditionalExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        @if (isset($monthlyHomeExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مصاريف البيت خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyHomeExpenses > 0 ? $monthlyHomeExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($monthlyFarmExpenses))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مصاريف المزرعة خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyFarmExpenses > 0 ? $monthlyFarmExpenses . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($monthlyReceiveMoney))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مشتريات اللبن خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlyReceiveMoney > 0 ? $monthlyReceiveMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($monthlySalesMoney))
                            <div class="col-md-3">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        مبيعات اللبن خلال الشهر
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $monthlySalesMoney > 0 ? $monthlySalesMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
<div class="row">
    @if (isset($monthlyBuffaloHome))
    <div class="col-md-3">
        <div class="card bg-secondary">
            <div style="font-weight: bold" class="card-header">
                كمية اللبن الجاموسي المباع في البيت خلال الشهر
            </div>
            <div style="font-weight: bold" class="card-body text-white">
                {{ $monthlyBuffaloHome > 0 ? $monthlyBuffaloHome . ' كيلو' : 'لا يوجد' }}
            </div>
        </div>
    </div>
@endif
@if (isset($monthlyCowHome))
    <div class="col-md-3">
        <div class="card bg-secondary">
            <div style="font-weight: bold" class="card-header">
                كمية اللبن البقري المباع في البيت خلال الشهر
            </div>
            <div style="font-weight: bold" class="card-body text-white">
                {{ $monthlyCowHome > 0 ? $monthlyCowHome . ' كيلو' : 'لا يوجد' }}
            </div>
        </div>
    </div>
@endif
</div>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
