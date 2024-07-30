document.addEventListener('DOMContentLoaded', () => {
    const addAppointmentButton = document.getElementById('addAppointmentButton');
    const addAppointmentModal = document.getElementById('addAppointmentModal');
    const closeModalButton = document.getElementById('closeModalButton');
    const addAppointmentForm = document.getElementById('addAppointmentForm');
    const appointmentsTableBody = document.getElementById('appointmentsTableBody');
    const patientCount = document.getElementById('patientCount');
    const upcomingAppointments = document.getElementById('upcomingAppointments');
    const recentActivities = document.getElementById('recentActivities');

    const appointments = [
        { patientName: 'John Doe', date: '2024-08-01', time: '10:00 AM' },
        { patientName: 'Jane Smith', date: '2024-08-02', time: '11:30 AM' },
    ];

    // const patients = [
    //     'John Doe',
    //     'Jane Smith'
    // ];

    // const activities = [
    //     'John Doe - Appointment added for 2024-08-01 at 10:00 AM',
    //     'Jane Smith - Appointment added for 2024-08-02 at 11:30 AM'
    // ];

    const renderAppointments = () => {
    //     appointmentsTableBody.innerHTML = '';
    //     upcomingAppointments.innerHTML = '';
    //     appointments.forEach((appointment, index) => {
    //         const row = document.createElement('tr');
    //         row.innerHTML = `
    //             <td class="py-2 px-4 border-b">${appointment.patientName}</td>
    //             <td class="py-2 px-4 border-b">${appointment.date}</td>
    //             <td class="py-2 px-4 border-b">${appointment.time}</td>
    //             <td class="py-2 px-4 border-b">
    //                 <button onclick="deleteAppointment(${index})" class="text-red-600 hover:text-red-800">Delete</button>
    //             </td>
    //         `;
    //         appointmentsTableBody.appendChild(row);
    //     });

    //     const listItem = document.createElement('li');
    //     var leny = appointments.length;
    //     listItem.textContent = `${appointments[1].patientName} - ${appointments[1].date} at ${appointments[1].time}`;
    //     upcomingAppointments.appendChild(listItem);

        // Update FullCalendar events
        
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            height: 350,
            contentHeight: 300,
            aspectRatio: 2,
            initialView: 'dayGridMonth',
            events: appointments.map(appointment => ({
                title: appointment.patientName,
                start: `${appointment.date}T${appointment.time}`,
                backgroundColor: '#2563eb',
                borderColor: '#2563eb'
            }))
        });
        calendar.render();
    };

    // const deleteAppointment = (index) => {
    //     activities.push(`${appointments[index].patientName} - Appointment deleted for ${appointments[index].date} at ${appointments[index].time}`);
    //     appointments.splice(index, 1);
    //     renderAppointments();
    //     renderActivities();
    // };


    // const renderActivities = () => {
    //     recentActivities.innerHTML = '';
    //     activities.slice(-5).forEach(activity => {
    //         const listItem = document.createElement('li');
    //         listItem.textContent = activity;
    //         recentActivities.appendChild(listItem);
    //     });
    // };
    // const updatePatientCount = () => {
    //     patientCount.textContent = patients.length;
    // };

    addAppointmentButton.addEventListener('click', () => {
        addAppointmentModal.classList.remove('hidden');
    });

    closeModalButton.addEventListener('click', () => {
        addAppointmentModal.classList.add('hidden');
    });

    addAppointmentForm.addEventListener('submit', (e) => {
    //     e.preventDefault();
    //     const formData = new FormData(addAppointmentForm);
    //     const newAppointment = {
    //         patientName: formData.get('patientName'),
    //         date: formData.get('appointmentDate'),
    //         time: formData.get('appointmentTime')
    //     };
    //     appointments.push(newAppointment);
    //     if (!patients.includes(newAppointment.patientName)) {
    //         patients.push(newAppointment.patientName);
    //     }
    //     activities.push(`${newAppointment.patientName} - Appointment added for ${newAppointment.date} at ${newAppointment.time}`);
        renderAppointments();
    //     updatePatientCount();
    //     renderActivities();
    //     addAppointmentModal.classList.add('hidden');
    //     addAppointmentForm.reset();
    });
    // updatePatientCount();
    // renderActivities();
    renderAppointments();

});
