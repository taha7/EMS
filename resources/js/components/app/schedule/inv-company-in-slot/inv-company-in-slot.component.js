import React, { memo, useState } from "react";

const InvCompanyInSlot = memo(({ invCompName, meetingsWithPresComp }) => {
    const [invCompState, setInvCompState] = useState({
        isInvsDisplayed: false
    });
    const toggleIcon = invCompState.isInvsDisplayed ? (
        <span>
            <i className="far fa-folder-open"></i>
        </span>
    ) : (
        <div style={{ display: "inline" }}>
            <i className="fas fa-folder-open"></i>
        </div>
    );
    return (
        <div className="inv-company">
            <span
                style={{ cursor: "pointer" }}
                onClick={() =>
                    setInvCompState({
                        ...invCompState,
                        isInvsDisplayed: !invCompState.isInvsDisplayed
                    })
                }
            >
                {toggleIcon} {invCompName}
            </span>
            {invCompState.isInvsDisplayed ? (
                <div className="invs-in-company-list">
                    {meetingsWithPresComp.map(m => (
                        <span
                            key={
                                m.id +
                                m.agenda_slot_id +
                                m.company_id +
                                m.client_id
                            }
                        >
                            <i class="fas fa-clipboard"></i>{" "}
                            {m.conference_client.client.first_name}
                        </span>
                    ))}
                </div>
            ) : null}
        </div>
    );
});

export default InvCompanyInSlot;
