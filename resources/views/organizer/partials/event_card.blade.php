<div class="card card-hover shadow-sm border-0 rounded-4 overflow-hidden event-card" 
                 data-category="{{ strtolower($event->category) }}" 
                 data-title="{{ strtolower($event->title) }}">
                <div class="position-relative h-100">
                    <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/no-img.jpg') }}"
                         alt="{{ $event->title }}" 
                         class="w-100 h-100 object-fit-cover">
                    <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                        <span class="small card-category">{{ $event->category }}</span>
                        <h5 class="card-title mb-1">{{ $event->title }}</h5>
                        <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</p>
                        <p class="small mb-1"><i class="fas fa-calendar me-1"></i>{{ $event->start_date->format('j F Y') }}</p>
                        <p class="small mb-2"><i class="fas fa-tag me-1"></i>{{ $price }}</p>
                        <div class="card-actions d-flex align-items-center gap-2">
                            @auth
                                <button type="button" 
                                    class="btn-favorite {{ auth()->user()->favorites->contains($event->id) ? 'favorited' : '' }}" 
                                    onclick="toggleFavorite(this, {{ $event->id }}, {{ auth()->user()->favorites->contains($event->id) ? 'true' : 'false' }})">
                                    <i class="{{ auth()->user()->favorites->contains($event->id) ? 'fas' : 'far' }} fa-heart"></i>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn-favorite" title="Login untuk menyimpan favorit">
                                    <i class="far fa-heart"></i>
                                </a>
                            @endauth

                            <a href="{{ route('events.show', $event) }}" class="btn btn-detail">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>