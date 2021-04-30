import './App.css';
import { useState, useEffect } from 'react';
import axios from 'axios';
import CarForm from './components/CarForm';

function App() {
  const [cars, setCars] = useState([]);
  const [selectedCar, setSelectedCar] = useState(null);

  // On attend que le DOM soit chargé
  useEffect(() => {
    axios.get('http://localhost/php/12-ajax/04-cars/cars.php')
      .then(response => setCars(response.data));
  }, []);

  return (
    <div className="App">
      <ul>
        {cars.map(car => 
          <li
            key={car.id}
            onClick={() => setSelectedCar(car)}
          >
            {car.brand}
          </li>
        )}
      </ul>

      {selectedCar && <h1>{selectedCar.brand}</h1>}

      <CarForm brand="Renault" onCarAdded={(car) => setCars(cars.concat(car))} />
    </div>
  );
}

export default App;
