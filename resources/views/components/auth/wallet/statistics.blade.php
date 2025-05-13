<div class="mt-10 flex flex-row sm:flex-nowrap flex-wrap sm:gap-10 gap-5 xl:min-h-[150px] lg:min-h-[100px] min-h-[50px] w-10/12 m-10
     sm:w-4/5 justify-center text-xs lg:text-md xl:text-lg">
    <div class="bg-blue-800 flex justify-center items-center sm:w-1/4 w-2/5 rounded-md">
        <div class="flex flex-col w-full h-[95%] bg-white shadow-[0_0_8px_-4px_rgba(0,0,0,1)] px-5 py-3 gap-2">
            <div class="flex flex-row gap-2  items-center">
                <i class="fa-solid fa-money-check-dollar"></i>
                <span>مجموع المبيعات</span>
            </div>
            <div class="flex flex-col w-full h-full bg-gray-200 rounded justify-evenly items-center">
                <div class="">دينار</div>
                <div class="">{{ $totalSales }}</div>
            </div>
        </div>
    </div>

    <div class="bg-blue-800 flex justify-center items-center sm:w-1/4 w-2/5 rounded-md">
        <div class="flex flex-col w-full h-[95%] bg-white shadow-[0_0_8px_-4px_rgba(0,0,0,1)] px-5 py-3 gap-2">
            <div class="flex flex-row gap-2  items-center">
                <i class="fa-solid fa-building-columns"></i>
                <span>مجموع الارباح</span>
            </div>
            <div class="flex flex-col w-full h-full bg-gray-200 rounded justify-evenly items-center">
                <div class="">دينار</div>
                <div class="">{{ $totalProfit }}</div>
            </div>
        </div>
    </div>
    
    <div class="bg-blue-800 flex justify-center items-center sm:w-1/4 w-2/5 rounded-md">
        <div class="flex flex-col w-full h-[95%] bg-white shadow-[0_0_8px_-4px_rgba(0,0,0,1)] px-2 py-3 gap-2">
            <div class="flex flex-row gap-2  items-center">
                <i class="fa-solid fa-money-check-dollar"></i>
                <span>مجموع الارباح من الطلبات</span>
            </div>
            <div class="flex flex-row h-full gap-2">
                <div class="flex flex-col w-full h-full bg-gray-200 rounded justify-evenly items-center">
                    <div class="">الطلبات</div>
                    <div class="">{{ $numOrders }}</div>
                </div>
    
                <div class="flex flex-col w-full h-full bg-gray-200 rounded justify-evenly items-center">
                    <div class="">دينار</div>
                    <div class="">{{ $totalProfit }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-blue-800 flex justify-center items-center sm:w-1/4 w-2/5 rounded-md">
        <div class="flex flex-col w-full h-[95%] bg-white shadow-[0_0_8px_-4px_rgba(0,0,0,1)] px-2 py-3 gap-2">
            <div class="flex flex-row gap-2  items-center">
                <i class="fa-solid fa-building-columns"></i>
                <span>ربح متوقع من الطلبات</span>
            </div>
            <div class="flex flex-row h-full gap-2">
    
                <div class="flex flex-col w-full h-full bg-gray-200 rounded justify-evenly items-center">
                    <div class="">الطلبات</div>
                    <div class="">{{ $numNextOrders }}</div>
                </div>
    
                <div class="flex flex-col w-full h-full bg-gray-200 rounded justify-evenly items-center">
                    <div class="">دينار</div>
                    <div class="">{{ $nextProfit }}</div>
                </div>
            </div>
        </div>
    </div>

</div>