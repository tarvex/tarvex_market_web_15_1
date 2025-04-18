<section class="overflow-hidden ">
    <div class="container px-0 px-md-3">
        <div class="flash-deals-wrapper">
            <div class="flash-deal-view-all-web row d-flex justify-content-end mb-3">
                @if ($web_config['flash_deals']->products_count > 0)
                    <a class="text-capitalize view-all-text web-text-primary"
                    href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}">
                        {{ translate('view_all')}}
                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                    </a>
                @endif
            </div>

            <?php
                $startDate = \Carbon\Carbon::parse($web_config['flash_deals']['start_date']);
                $endDate = \Carbon\Carbon::parse($web_config['flash_deals']['end_date']);
                $now = \Carbon\Carbon::now();
                $totalDuration = $endDate->diffInSeconds($startDate);
                $elapsedDuration = $now->diffInSeconds($startDate);
                $flashDealsPercentage = ($elapsedDuration / $totalDuration) * 100;
            ?>

            <div class="row g-3 mx-max-md-0">
                <div class="col-lg-4 px-max-md-0 flashdeal-responsive">
                    <a href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}" class="countdown-card bg-transparent">
                        <div class="flash-deal-text web-text-primary">
                            <h1 class="web-text-primary lh-1 h3 letter-spacing-0">
                                <span>{{$web_config['flash_deals']->title}}</span>
                            </h1>
                            {{-- <small>{{translate('hurry_Up')}} ! {{translate('the_offer_is_limited')}}. {{translate('grab_while_it_lasts')}}</small> --}}
                            <h2 class="fs-16 font-weight-normal web-text-primary mb-0">{{translate('hurry_Up')}} ! {{translate('the_offer_is_limited')}}. {{translate('grab_while_it_lasts')}}</h2>
                        </div>
                        <div class="text-center text-white">
                            <div class="countdown-background">
                                <span class="cz-countdown d-flex justify-content-center align-items-center flash-deal-countdown"
                                    data-countdown="{{$web_config['flash_deals']?date('m/d/Y',strtotime($web_config['flash_deals']['end_date'])):''}} 23:59:00 ">
                                    <span class="cz-countdown-days">
                                        <span class="cz-countdown-value"></span>
                                        <span class="cz-countdown-text text-nowrap">{{ translate('days')}}</span>
                                    </span>
                                    <span class="cz-countdown-value p-1">:</span>
                                    <span class="cz-countdown-hours">
                                        <span class="cz-countdown-value"></span>
                                        <span class="cz-countdown-text text-nowrap">{{ translate('hours')}}</span>
                                    </span>
                                    <span class="cz-countdown-value p-1">:</span>
                                    <span class="cz-countdown-minutes">
                                        <span class="cz-countdown-value"></span>
                                        <span class="cz-countdown-text text-nowrap">{{ translate('minutes')}}</span>
                                    </span>
                                    <span class="cz-countdown-value p-1">:</span>
                                    <span class="cz-countdown-seconds">
                                        <span class="cz-countdown-value"></span>
                                        <span class="cz-countdown-text text-nowrap">{{ translate('seconds')}}</span>
                                    </span>
                                </span>
                                <div class="progress __progress">
                                <div class="progress-bar flash-deal-progress-bar" role="progressbar" style="width: {{ number_format($flashDealsPercentage, 2) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                @php($nullFilter = 0)
                @foreach($flashDeal['flashDealProducts'] as $key => $flashDealProduct)
                    @php($nullFilter = $nullFilter+1)
                @endforeach

                @if($nullFilter<=10)
                    <div class="col-lg-8 d-none d-md-block px-max-md-0">
                        <div class="owl-theme owl-carousel flash-deal-slider">
                            @foreach($flashDeal['flashDealProducts'] as $key => $flashDealProduct)
                                @include('web-views.partials._feature-product',['product'=> $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                            @endforeach
                        </div>
                    </div>
                @else
                    @php($index = 0)
                    @foreach($flashDeal['flashDealProducts'] as $key=>$flashDealProduct)
                        @if ($index<10)
                            @php($index = $index+1)
                            <div class="col-lg-2 col-6 col-sm-4 col-md-3 d-none d-md-block px-max-md-0">
                                @include('web-views.partials._feature-product',['product'=> $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                            </div>
                        @endif
                    @endforeach
                @endif

                <div class="col-12 pb-0 d-md-none px-max-md-0">
                    <div class="owl-theme owl-carousel flash-deal-slider-mobile">
                        @foreach($flashDeal['flashDealProducts'] as $key=>$flashDealProduct)
                            @if( $key<10)
                                @include('web-views.partials._product-card-1',['product' => $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                            @endif
                        @endforeach
                    </div>
                </div>
                @if (count($flashDeal['flashDealProducts']) > 0)
                    <div class="col-12 d-md-none text-center px-max-md-0">
                        <a class="text-capitalize view-all-text web-text-primary"
                            href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}">
                            {{ translate('view_all')}}
                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>
