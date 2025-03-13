<x-application-tools-wrapper>
    <x-tool-wrapper :tool="$tool">
        <x-ad-slot :advertisement="get_advert_model('above-form')"/>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mb-4">
                    <span class="h1 text-success" id="result-unit-number"></span>
                    <span class="text-muted" id="result-unit"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-input-label class="text-center d-block h4">
                        @lang('tools.from'):
                        <span class="ms-1" id="fromUnit"></span>
                    </x-input-label>
                    <div class="input-group">
                        <x-text-input value="1" class="form-control" name="from" type="number"
                            id="input_1" step="0.01" required />
                        <x-copy-target-group target="input_1" />
                    </div>
                </div>
                <div class="form-group mb-4">
                    <select name="from_unit" id="unit_1" required class="form-control form-select">
                        <option>Acre (acre)</option>
                        <option>Are</option>
                        <option>Barn (barn)</option>
                        <option>Circular mil</option>
                        <option>Hectare</option>
                        <option>Rood</option>
                        <option>Square centimeter</option>
                        <option>Square foot (ft^2)</option>
                        <option>Square inch (in^2)</option>
                        <option>Square kilometer</option>
                        <option>Square meter (m^2)</option>
                        <option>Square mile (mi^2)</option>
                        <option>Square yard (yd^2)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-input-label class="text-center d-block h4">
                        @lang('tools.to'):
                        <span class="ms-1" id="toUnit"></span>
                    </x-input-label>
                    <div class="input-group">
                        <x-text-input value="1" class="form-control" name="to" type="number" step="0.01"
                            id="input_2" required />
                        <x-copy-target-group target="input_2" />
                    </div>
                </div>
                <div class="form-group mb-4">
                    <select name="to_unit" id="unit_2" required class="form-control form-select">
                        <option>Acre (acre)</option>
                        <option>Are</option>
                        <option>Barn (barn)</option>
                        <option>Circular mil</option>
                        <option>Hectare</option>
                        <option>Rood</option>
                        <option>Square centimeter</option>
                        <option>Square foot (ft^2)</option>
                        <option>Square inch (in^2)</option>
                        <option>Square kilometer</option>
                        <option>Square meter (m^2)</option>
                        <option>Square mile (mi^2)</option>
                        <option>Square yard (yd^2)</option>
                    </select>
                </div>
            </div>
        </div>
    </x-tool-wrapper>
    <x-ad-slot :advertisement="get_advert_model('below-result')"/>
    <x-tool-content :tool="$tool" />
    @push('page_scripts')
        <script>
            const APP = function() {
                const factor = new Array();
                factor[0] = new Array(4046.856, 100, 1E-28, 5.067075E-10, 10000, 1011.71413184285, .0001, 9.290304E-02,
                    6.4516E-04, 1000000, 1, 2589988, .8361274);

                const regx = /^-?(\d+\.?\d*)$|(\d*\.?\d+)$/,
                    CalculateUnit = function(source, target) {
                        var val_1 = document.getElementById('input_1').value;
                        var val_2 = document.getElementById('input_2').value;
                        if (!regx.test(val_1) || !regx.test(val_2)) {
                            ArtisanApp.toastError('{{ __('tools.powerConverterError') }}');
                            document.getElementById('input_1').value = 1;
                            document.getElementById('input_2').value = 1;

                            return;
                        }
                        sourceIndex = document.getElementById("unit_" + source).selectedIndex;
                        sourceFactor = factor[0][sourceIndex];

                        targetIndex = document.getElementById("unit_" + target).selectedIndex;
                        targetFactor = factor[0][targetIndex];
                        console.log(sourceFactor, targetFactor)

                        var get_input_id = "input_" + source;
                        result = document.getElementById(get_input_id).value;

                        result = result * sourceFactor;
                        result = result / targetFactor;
                        result = result.round(4)

                        var get_input2_id = "input_" + target;
                        document.getElementById(get_input2_id).value = result;
                        document.getElementById('result-unit-number').innerHTML = result;
                        document.getElementById('result-unit').innerHTML = document.getElementById("unit_" + target).value;
                    },
                    attachEvents = function() {
                        document.getElementById('fromUnit').innerHTML = document.querySelector('#unit_1').value
                        document.getElementById('toUnit').innerHTML = document.querySelector('#unit_2').value

                        document.querySelector('#input_1').addEventListener('keyup', () => {
                            CalculateUnit('1', '2');
                        });
                        document.querySelector('#input_2').addEventListener('keyup', () => {
                            CalculateUnit('2', '1');
                        });
                        document.querySelector('#input_1').addEventListener('change', () => {
                            CalculateUnit('1', '2');
                        });
                        document.querySelector('#input_2').addEventListener('change', () => {
                            CalculateUnit('2', '1');
                        });
                        document.querySelector('#unit_1').addEventListener('change', (e) => {
                            document.getElementById('fromUnit').innerHTML = e.target.value
                            CalculateUnit('1', '2');
                        });
                        document.querySelector('#unit_2').addEventListener('change', (e) => {
                            document.getElementById('toUnit').innerHTML = e.target.value
                            CalculateUnit('1', '2');
                        });
                    };
                return {
                    init: function() {
                        attachEvents()
                        CalculateUnit('1', '2')
                    },
                }
            }();
            document.addEventListener("DOMContentLoaded", function(event) {
                APP.init();
            });
        </script>
    @endpush
</x-application-tools-wrapper>
