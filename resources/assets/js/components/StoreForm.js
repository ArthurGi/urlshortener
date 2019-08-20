import React, {Component} from 'react';


class StoreForm extends Component {

    constructor(props) {
        super(props);
        /* Initialize the state. */
        this.state = {
            newLink: {
                url: '',
            }
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleInput = this.handleInput.bind(this);
    }

    handleInput(key, e) {
        let state = Object.assign({}, this.state.newLink);
        state[key] = e.target.value;
        this.setState({newLink: state});
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.onStore(this.state.newLink);
    }

    getErrors() {
        let errors = this.props.errors;
        if (errors) {
            return Object.keys(errors).map(key => {
                return (
                    <div key={key} className="alert-danger">
                        {key + ' : ' + errors[key]}
                    </div>
                );
            });

        }
        return '';
    }

    render() {

        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <div className="input-block">
                        <input type="text" name="url" className="form-control" placeholder="Enter URL"
                               onChange={(e) => this.handleInput('url', e)}/>
                        <div className="but-block">
                            <button className="btn btn-success" type="submit">Generate Shorten Link</button>
                        </div>
                        {this.getErrors()}
                    </div>
                </form>
            </div>
        );
    }
}


export default StoreForm;
