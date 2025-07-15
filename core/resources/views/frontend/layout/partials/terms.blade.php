<div class="modal-terms-container">
<div class="modal-backdrop fade show hideItem"></div>
<div class="modal show hideItem" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="currencyModalLabel" aria-hidden="false" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="currencyModalLabel">Sobunny</h5>
            </div> --}}
            <div class="modal-body">

                <div>
                    <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" style="max-width: 200px" class="mt-2 mb-5 center d-flex m-auto">
                    {{-- <h5 class="modal-title" id="currencyModalLabel">Sobunny</h5> --}}


                </div>

                <div class="d-flex flex-column mt-5 terms_text_container">
                    <p class="mb-2"> <strong>This website contains adult content</strong></p>

                    <p class="mb-4">By continuing to use Sobunny, you agree you're <strong class="over_18">over the age of 18 </strong>and have read and agreed to <a href="/terms-and-conditions">our terms.</a></p>
                    <p>Parents/guardians, you can learn more about online safety in the Assembly Four parents guide to adult content.</p>
                    <p class="no_tolerance mt-4">
                        Sobunny has a zero-tolerance policy toward human trafficking, prostitution, and any other illegal conduct. We cooperate with law enforcement, pursuant to appropriate process, such as a subpoena, in investigating criminal activity. Activity that violates our zero-tolerance policy may result in a referral to law enforcement. I have no intention to, and will not, use this site in violation of Eros’s policies or any federal, state, or local law, and I agree to report violations to the appropriate authorities.
                    </p>
                    <p class="i_also mt-4">
                        
                        <div class="form-group accept_container" style="justify-content: center;
                        align-items: center;
                        display: flex;">
                            {{-- <label>Guardar </label> --}}
                            <label class="switch">
                                <input type="checkbox" class="check_accept" >
                                <span class="slider round"></span>
                            </label>
                            <p style="  
                                width: 80%;
    margin: auto;
    font-size: 0.75rem;
  width: 85%;
                            
    margin: auto;">I also agree to report suspected exploitation of minors and/or human trafficking to the appropriate authorities.</p>
                        </div>

    
                    </p>
    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn_accept_terms">I Agree</button>
                <button type="button" class="btn btn-dark btn_decline">Decline</button>
            </div>
        </div>
    </div>
</div>
</div>
