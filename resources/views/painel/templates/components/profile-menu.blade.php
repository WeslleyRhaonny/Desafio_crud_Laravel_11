
<li>
    <a class="dropdown-item" href="">
        <div class="d-flex">
            <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online" style="height: 3rem; width: 3rem;">
                
                    <img src="{{ asset('stalo_logo2.png') }}" alt="" class="h-100 w-100 rounded-circle" />
                
                </div>
            </div>
            <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{auth()->user()->email}}</span>
                <small class="text-muted"></small>
            </div>
        </div>
    </a>
</li>

<!-- --------------- Divider --------------- -->
<li>
    <div class="dropdown-divider"></div>
</li>

<!-- Log Out -->
<li>
    <form action="{{route('painel.logout')}}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item">
            <i class="ti ti-power-off me-2 ti-sm"></i>
            <span class="align-middle">Sair</span>
        </button>
    </form>
</li>


<li>
    <div class="dropdown-divider"></div>
</li>

<li style="font-size: 8pt;" class="px-3">
   
    <span>Desenvolvido por:</span>
    <ul>
        <li>Sistema: Weslley Rhaonny</li>
    </ul>

</li>