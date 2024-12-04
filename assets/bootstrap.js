import { startStimulusApp } from '@symfony/stimulus-bundle';
import AnimatedNumber from '@stimulus-components/animated-number'

const app = startStimulusApp();
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
app.register('animated-number', AnimatedNumber)
