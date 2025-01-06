<div class="stepper mb-8">
    <div class="flex justify-between">
        @for ($i = 1; $i <= 4; $i++)
            <div class="step-item {{ $i <= $currentStep ? 'active' : '' }}">
                <div class="step">{{ $i }}</div>
                <p class="text-xs mt-2">
                    {{
                        $i === 1 ? 'Personal Info' :
                        ($i === 2 ? 'Guest Count' :
                        ($i === 3 ? 'Meal Selection' : 'Confirmation'))
                    }}
                </p>
            </div>
        @endfor
    </div>
    <div class="flex justify-between">
        @for ($i = 1; $i < 4; $i++)
            <div class="step-line {{ $i < $currentStep ? 'active' : '' }}"></div>
        @endfor
    </div>
</div>

