@extends('admin.layout.default')

@section('content')
    <!-- Dashboard Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div
            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">إجمالي الطلبات</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">1,247</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">+12%</span>
                        <span class="text-gray-500 text-sm mr-2">من الشهر الماضي</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div
            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">إجمالي المبيعات</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">₪89,240</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">+8.2%</span>
                        <span class="text-gray-500 text-sm mr-2">من الشهر الماضي</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Customers -->
        <div
            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">العملاء النشطين</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">342</p>
                    <div class="flex items-center mt-2">
                        <span class="text-blue-500 text-sm font-medium">+5.4%</span>
                        <span class="text-gray-500 text-sm mr-2">من الشهر الماضي</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div
            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">الطلبات المعلقة</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">23</p>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 text-sm font-medium">-2.1%</span>
                        <span class="text-gray-500 text-sm mr-2">من الشهر الماضي</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Sales Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">مبيعات الشهر الحالي</h3>
                <div class="flex space-x-2 space-x-reverse">
                    <button class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium">شهري</button>
                    <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg text-sm font-medium">أسبوعي</button>
                    <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg text-sm font-medium">يومي</button>
                </div>
            </div>
            <div class="h-64 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-600">مخطط المبيعات الشهرية</p>
                    <p class="text-sm text-gray-500 mt-1">البيانات متاحة قريباً</p>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">المنتجات الأكثر مبيعاً</h3>
            <div class="space-y-4">
                <div
                    class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">منتج المياه الغازية</p>
                            <p class="text-sm text-gray-500">345 وحدة مباعة</p>
                        </div>
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-900">₪12,450</p>
                        <p class="text-sm text-green-600">+15%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">عصائر طبيعية</p>
                            <p class="text-sm text-gray-500">287 وحدة مباعة</p>
                        </div>
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-900">₪9,870</p>
                        <p class="text-sm text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">وجبات خفيفة</p>
                            <p class="text-sm text-gray-500">203 وحدة مباعة</p>
                        </div>
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-900">₪7,620</p>
                        <p class="text-sm text-red-600">-3%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">4</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">منتجات الألبان</p>
                            <p class="text-sm text-gray-500">156 وحدة مباعة</p>
                        </div>
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-900">₪5,890</p>
                        <p class="text-sm text-green-600">+12%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and Activity -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="xl:col-span-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50">
            <div class="p-6 border-b border-gray-200/50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">الطلبات الأخيرة</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">عرض الكل</a>
                </div>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="pb-3">رقم الطلب</th>
                                <th class="pb-3">العميل</th>
                                <th class="pb-3">المبلغ</th>
                                <th class="pb-3">الحالة</th>
                                <th class="pb-3">التاريخ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 text-sm font-medium text-gray-900">#1247</td>
                                <td class="py-4 text-sm text-gray-900">أحمد محمد</td>
                                <td class="py-4 text-sm text-gray-900">₪450</td>
                                <td class="py-4">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">مكتمل</span>
                                </td>
                                <td class="py-4 text-sm text-gray-500">2024/12/01</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 text-sm font-medium text-gray-900">#1246</td>
                                <td class="py-4 text-sm text-gray-900">فاطمة علي</td>
                                <td class="py-4 text-sm text-gray-900">₪320</td>
                                <td class="py-4">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">قيد
                                        المعالجة</span>
                                </td>
                                <td class="py-4 text-sm text-gray-500">2024/12/01</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 text-sm font-medium text-gray-900">#1245</td>
                                <td class="py-4 text-sm text-gray-900">محمد خالد</td>
                                <td class="py-4 text-sm text-gray-900">₪780</td>
                                <td class="py-4">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">قيد
                                        الشحن</span>
                                </td>
                                <td class="py-4 text-sm text-gray-500">2024/11/30</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 text-sm font-medium text-gray-900">#1244</td>
                                <td class="py-4 text-sm text-gray-900">سارة أحمد</td>
                                <td class="py-4 text-sm text-gray-900">₪190</td>
                                <td class="py-4">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">ملغي</span>
                                </td>
                                <td class="py-4 text-sm text-gray-500">2024/11/30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50">
            <div class="p-6 border-b border-gray-200/50">
                <h3 class="text-lg font-semibold text-gray-900">النشاط الأخير</h3>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <div class="flex items-start space-x-3 space-x-reverse">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l.68 10.18a1 1 0 01-1 1.07H5.32a1 1 0 01-1-1.07L5 9z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">طلب جديد تم استلامه</p>
                            <p class="text-xs text-gray-500 mt-1">قبل 5 دقائق</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 space-x-reverse">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">تم تأكيد الطلب #1247</p>
                            <p class="text-xs text-gray-500 mt-1">قبل 15 دقيقة</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 space-x-reverse">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">عميل جديد تم التسجيل</p>
                            <p class="text-xs text-gray-500 mt-1">قبل 30 دقيقة</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 space-x-reverse">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">تم شحن الطلب #1245</p>
                            <p class="text-xs text-gray-500 mt-1">قبل ساعة</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 space-x-reverse">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">تحذير: مخزون منخفض</p>
                            <p class="text-xs text-gray-500 mt-1">قبل ساعتين</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200">
                    <a href="#" class="block text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                        عرض جميع الأنشطة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">إجراءات سريعة</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button class="p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors text-center">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">إضافة طلب</span>
            </button>

            <button class="p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors text-center">
                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">إضافة عميل</span>
            </button>

            <button class="p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors text-center">
                <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center mx-auto mb-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">إضافة منتج</span>
            </button>

            <button class="p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-colors text-center">
                <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center mx-auto mb-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">عرض تقرير</span>
            </button>
        </div>
    </div>
@endsection
