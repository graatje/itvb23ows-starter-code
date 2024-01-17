# Branchingstrategie
De strategie die is gekozen voor dit project is het merendeel van de gitflow workflow. Dit houd in dat er een main branch is, een develop branch en feature branches die in de develop branch worden gemerged via een merge request.

Er is voor deze strategie gekozen om het aantal bugs in productie laag te houden. Op deze manier worden nieuwe features namelijk in de develop branch gezet. Deze develop branch zou eventueel op een server gezet kunnen worden zodat deze branch door een aantal aangewezen testgebruikers en ontwikkelaars getest kan worden op bugs voordat de echte eindgebruikers last van bugs zouden hebben.

Mochten er toch bugs in de main branch komen die een hotfix nodig zijn dan wordt er een merge request voor een hotfix aangemaakt die rechtstreeks naar de main branch wordt gemerged. Een hotfix is namelijk alleen voor bugs die een hoge prioriteit hebben en die zo snel mogelijk opgelost moeten worden, en dus zo snel mogelijk in productie moeten.

## Merge requests
Elke merge request moet worden goedgekeurd door andere developers wanneer er meerdere developers aan dit project werken, voor een merge request zijn er dus approval rules voordat deze gemerged kan worden. Wanneer er meerdere personen naar code kijken dan is er een grotere kans dat developers bugs vinden in de code namelijk. 
Voor een hotfix die naar de main toe wordt gemerged zijn er wel meer approvals nodig dan voor een reguliere merge request die naar de develop branch toegaan, aangezien eindgebruikers er meteen last van zouden hebben wanneer een bug op de main branch ontstaat. 