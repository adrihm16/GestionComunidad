{{--
    Dynamic Calendar Component

    Usage:
    @include('components.ui.calendar', ['calendarData' => $calendarData])

    $calendarData expected keys:
    - year, month, monthName, daysInMonth, startDayOfWeek, today, eventDays, events
--}}

<div id="calendar-widget">
    @component('components.ui.card', ['hover' => false])
        {{-- Month header --}}
        <div class="flex items-center justify-between mb-3">
            <button id="cal-prev" class="p-1.5 rounded-lg hover:bg-primary/10 transition-colors" aria-label="Mes anterior">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <span id="cal-month-label" class="font-semibold text-sm text-main">
                {{ $calendarData['monthName'] }} {{ $calendarData['year'] }}
            </span>
            <button id="cal-next" class="p-1.5 rounded-lg hover:bg-primary/10 transition-colors" aria-label="Mes siguiente">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        {{-- Day labels --}}
        <div class="grid grid-cols-7 gap-1 mb-1">
            @foreach(['L', 'M', 'X', 'J', 'V', 'S', 'D'] as $day)
                <div class="text-center text-xs font-medium text-muted py-1">{{ $day }}</div>
            @endforeach
        </div>

        {{-- Calendar grid --}}
        <div id="cal-grid" class="grid grid-cols-7 gap-1 transition-opacity duration-200">
            {{-- Empty cells before first day --}}
            @for($i = 0; $i < $calendarData['startDayOfWeek']; $i++)
                <div></div>
            @endfor

            @for($day = 1; $day <= $calendarData['daysInMonth']; $day++)
                @php
                    $isToday = ($day == $calendarData['today']);
                    $hasEvent = isset($calendarData['eventDays'][$day]);
                @endphp
                <div class="relative flex items-center justify-center w-full aspect-square rounded-lg text-xs font-medium
                            transition-all duration-200
                            {{ $isToday
                                ? 'bg-primary text-white shadow-sm'
                                : 'text-main hover:bg-primary/10' }}">
                    {{ $day }}
                    @if($hasEvent && !$isToday)
                        <span class="absolute bottom-0.5 w-1 h-1 rounded-full bg-accent"></span>
                    @endif
                    @if($hasEvent && $isToday)
                        <span class="absolute bottom-0.5 w-1 h-1 rounded-full bg-white"></span>
                    @endif
                </div>
            @endfor
        </div>

        {{-- Events legend --}}
        <div id="cal-events" class="mt-3 pt-3 border-t border-gray-100 transition-opacity duration-200">
            @if(count($calendarData['events']) > 0)
                <div class="flex flex-col gap-2">
                    @foreach($calendarData['events'] as $event)
                        <div class="flex items-start gap-2 text-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span>
                            <div class="flex-1">
                                <span class="font-medium text-main">{{ $event['titulo'] }}</span>
                                <span class="text-muted ml-1">
                                    — {{ $event['fecha_inicio'] }}
                                    @if($event['multiday'])
                                        → {{ $event['fecha_fin'] }}
                                    @else
                                        · {{ $event['hora'] }}h
                                    @endif
                                </span>
                            </div>
                            @php
                                $tipoBadge = match($event['tipo']) {
                                    'junta' => 'bg-blue-100 text-blue-700',
                                    'mantenimiento' => 'bg-amber-100 text-amber-700',
                                    'obra' => 'bg-orange-100 text-orange-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium {{ $tipoBadge }}">
                                {{ ucfirst($event['tipo']) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-muted text-center">Sin eventos este mes</p>
            @endif
        </div>
    @endcomponent
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentYear = {{ $calendarData['year'] }};
    let currentMonth = {{ $calendarData['month'] }};

    const prevBtn = document.getElementById('cal-prev');
    const nextBtn = document.getElementById('cal-next');
    const monthLabel = document.getElementById('cal-month-label');
    const grid = document.getElementById('cal-grid');
    const eventsContainer = document.getElementById('cal-events');

    function navigateMonth(direction) {
        currentMonth += direction;
        if (currentMonth > 12) { currentMonth = 1; currentYear++; }
        if (currentMonth < 1) { currentMonth = 12; currentYear--; }

        // Fade out
        grid.style.opacity = '0.3';
        eventsContainer.style.opacity = '0.3';

        fetch(`/api/calendar/${currentYear}/${currentMonth}`)
            .then(res => res.json())
            .then(data => {
                // Update month label
                monthLabel.textContent = `${data.monthName} ${data.year}`;

                // Rebuild grid
                let html = '';
                for (let i = 0; i < data.startDayOfWeek; i++) {
                    html += '<div></div>';
                }
                for (let day = 1; day <= data.daysInMonth; day++) {
                    const isToday = (day === data.today);
                    const hasEvent = data.eventDays && data.eventDays[day];

                    const classes = isToday
                        ? 'bg-primary text-white shadow-sm'
                        : 'text-main hover:bg-primary/10';

                    let dot = '';
                    if (hasEvent && !isToday) {
                        dot = '<span class="absolute bottom-0.5 w-1 h-1 rounded-full bg-accent"></span>';
                    }
                    if (hasEvent && isToday) {
                        dot = '<span class="absolute bottom-0.5 w-1 h-1 rounded-full bg-white"></span>';
                    }

                    html += `<div class="relative flex items-center justify-center w-full aspect-square rounded-lg text-xs font-medium transition-all duration-200 ${classes}">
                        ${day}${dot}
                    </div>`;
                }
                grid.innerHTML = html;

                // Rebuild events legend
                if (data.events && data.events.length > 0) {
                    let evHtml = '<div class="flex flex-col gap-2">';
                    data.events.forEach(ev => {
                        const badges = {
                            'junta': 'bg-blue-100 text-blue-700',
                            'mantenimiento': 'bg-amber-100 text-amber-700',
                            'obra': 'bg-orange-100 text-orange-700',
                            'otro': 'bg-gray-100 text-gray-600',
                        };
                        const badgeClass = badges[ev.tipo] || badges['otro'];
                        const dateText = ev.multiday
                            ? `${ev.fecha_inicio} → ${ev.fecha_fin}`
                            : `${ev.fecha_inicio} · ${ev.hora}h`;

                        evHtml += `
                            <div class="flex items-start gap-2 text-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span>
                                <div class="flex-1">
                                    <span class="font-medium text-main">${ev.titulo}</span>
                                    <span class="text-muted ml-1">— ${dateText}</span>
                                </div>
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium ${badgeClass}">
                                    ${ev.tipo.charAt(0).toUpperCase() + ev.tipo.slice(1)}
                                </span>
                            </div>`;
                    });
                    evHtml += '</div>';
                    eventsContainer.innerHTML = evHtml;
                } else {
                    eventsContainer.innerHTML = '<p class="text-xs text-muted text-center">Sin eventos este mes</p>';
                }

                // Fade in
                grid.style.opacity = '1';
                eventsContainer.style.opacity = '1';
            })
            .catch(err => {
                console.error('Calendar fetch error:', err);
                grid.style.opacity = '1';
                eventsContainer.style.opacity = '1';
            });
    }

    prevBtn.addEventListener('click', () => navigateMonth(-1));
    nextBtn.addEventListener('click', () => navigateMonth(1));
});
</script>
