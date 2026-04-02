<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifications Center') }}
            </h2>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <a href="{{ route('notifications.markRead') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Mark All as Read
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Your Notifications
                    </h3>
                    <span class="text-sm font-medium text-gray-500">{{ auth()->user()->unreadNotifications->count() }} Unread</span>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($notifications as $note)
                        <div class="p-6 transition-all duration-200 hover:bg-gray-50 {{ $note->unread() ? 'bg-indigo-50/30 border-l-4 border-indigo-500' : '' }}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    @if($note->unread())
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $note->data['message'] }}
                                        </p>
                                        <time class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</time>
                                    </div>
                                    <div class="mt-2 flex items-center">
                                        <span class="text-xs font-black text-indigo-600 uppercase tracking-tighter">
                                            Product Update
                                        </span>
                                        @if($note->unread())
                                            <span class="ml-2 h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-100 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="text-gray-400 font-medium">All caught up! No notifications yet.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($notifications->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
