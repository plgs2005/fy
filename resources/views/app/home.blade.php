Olá Mundo - {{$user}}<br /><br />

@foreach($components as $component)
	Icone: {{$component->getMenuIcon()}}<br />
	Menu Hint: {{$component->getMenuHint()}}<br />
	<br />
@endforeach