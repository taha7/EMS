import React from "react";
import ReactDOM from "react-dom";

const CompanyScheduleWithInvsContacts = () => (
    <div className="container-fluid" style={{ height: "100%" }}>
        Hello
    </div>
);

const elem = document.getElementById("company-schedule-with-invs-contacts");

if (elem) {
    ReactDOM.render(<CompanyScheduleWithInvsContacts />, elem);
}

export default CompanyScheduleWithInvsContacts;
