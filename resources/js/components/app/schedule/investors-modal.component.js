import Axios from "axios";
import React, { useEffect } from "react";
import { connect } from "react-redux";
import Select2 from "react-select2-wrapper";
import 'react-select2-wrapper/css/select2.css';

const options = ["chocolate", "strawberry", "vanilla"];

const InvestorsModal = ({ loadInvestors, investorsModal }) => {
    useEffect(() => {
        /**
         * only load investors when slot is opened
         * that means that we have slot id
         */
        if (investorsModal.startingData.slot.id) {
            console.log("Will rerender investors modal");
            loadInvestors(investorsModal);
        }
    }, [
        investorsModal.startingData.slot // when slot changed reload investors
    ]);

    return (
        <div
            className="modal fade"
            id="investorsModal"
            tabIndex="-1"
            role="dialog"
            aria-labelledby="investorsModalLabel"
            aria-hidden="true"
        >
            <div className="modal-dialog" role="document" style={{ maxWidth: '1400px' }}>
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="investorsModalLabel">
                            Modal title
                        </h5>
                        <button
                            type="button"
                            className="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <table className="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Primary Signnatory</th>
                                    <th scope="col">Meeting Type</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Share Holder</th>
                                    <th scope="col">Knowledge</th>
                                    <th scope="col">In Pref</th>
                                </tr>
                                <tr>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div className="filter-column">
                                            <Select2
                                                className='form-control'
                                                multiple
                                                data={options}
                                            />
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {investorsModal.investors.map(inv => (
                                    <tr
                                        key={
                                            inv.id +
                                            investorsModal.startingData.slot
                                                .id +
                                            investorsModal.startingData.company
                                                .id
                                        }
                                    >
                                        <th scope="row">1</th>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.family_name}</td>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.first_name}</td>
                                        <td>{inv.first_name}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    <div className="modal-footer">
                        <button
                            type="button"
                            className="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" className="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
};

const mapStateToProps = ({ scheduleReducer }) => ({
    investorsModal: scheduleReducer.investorsModal
});

const mapDispatchToProps = dispatch => {
    return {
        loadInvestors: () => {
            Axios.get("/investors").then(({ data }) =>
                dispatch({
                    type: "SET_INVESTORS_IN_INVESTORS_MODAL",
                    payload: data
                })
            );
        }
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(InvestorsModal);
