import React from 'react';
import axios from 'axios';

class CarForm extends React.Component {
    // Quand le composant est créé
    constructor(props) {
        super(props);

        this.state = {
            brand: props.brand,
            model: '',
            price: ''
        };
    }

    handleChange(e) {
        console.log(e.target.name);
        console.log(e.target.value);
        // [e.target.name]: e.target.value équivaut à brand: 'Toyota'
        this.setState({[e.target.name]: e.target.value});
    }

    handleSubmit(e) {
        e.preventDefault();
        console.log(this.state);
        // URLSearchParams permet de préciser que c'est un "formulaire"
        axios.post('http://localhost/php/12-ajax/04-cars/add_ajax.php', new URLSearchParams(this.state)).then(
            response => this.props.onCarAdded(response.data)
        );
    }

    render() {
        // let disabled = this.state.brand.length <= 0;
        // disabled |= this.state.model.length <= 0;
        // disabled |= this.state.price.length <= 0;
        let disabled = false;

        if (this.state.brand.length <= 0 || this.state.model.length <= 0 || this.state.price.length <= 0) {
            disabled = true;
        }

        // On peut afficher une erreur en fonction du state
        let error;
        if (this.state.brand.length <= 0) {
            error = 'La marque est vide';
        }

        return (
            <form onSubmit={e => this.handleSubmit(e)}>
                <label>Marque</label>
                <input type="text" name="brand" value={this.state.brand} onChange={e => this.handleChange(e)} />
                <label>Modèle</label>
                <input type="text" name="model" value={this.state.model} onChange={e => this.handleChange(e)} />
                <label>Prix</label>
                <input type="text" name="price" value={this.state.price} onChange={e => this.handleChange(e)} />

                <button disabled={disabled}>Ajouter</button>

                {error && <h1>{error}</h1>}
                {/* On affiche la valeur d'un champ s'il n'y a pas d'erreur */}
                {!error && <h1>{this.state.brand}</h1>}
            </form>
        );
    }
}

export default CarForm;
