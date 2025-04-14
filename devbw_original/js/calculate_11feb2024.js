class MyConstractor {

    constructor() {

        self = this;    
                
        this.pdf = {
            region : {
                id : "",
                name : "",
            },
            country : {
                id : "",
                name : "",
            },
            city : {
                id : "",
                name : "",
            },
            centre : {
                id : "",
                name : "",
                enrolment_fee : "",
                bank_change : "",
            },
            course : {
                id : "",
                name : "",
                start_date : "",
                end_date : "",
                number_weeks : "",
                price : "",
                prices : "",
                insurance : "",
                insurances : "",
                summerFee : "",
                waived : "",
                discount_percent : "",
                discount_amount : ""
            },
            addon: {
                id : "",
                name : "",
                price : "",
                prices : "",
                number_weeks : "",
                start_date : ""
            },
            family: {
                id : "",
                name : "",
                lessons : "",
                start_date : "",
                end_date : "",
                price : "",
                extra : "",
                prices : "",
                number_weeks : "",
            },
            exam: {
                id : "",
                name : "",
                lessons : "",
                start_date : "",
                price : "",
                number_weeks : "",
            },
            professional: {
                id : "",
                name : "",
                start_date : "",
                price : "",
                number_weeks : "",
            },
            accommodation : {
                start_date: "",
                end_date: "",
                discount: "",
                percent: "",
                weeks: "",
                price: "",
                prices: "",
                total : "",
                fees : "",
                summer_fees : "",
                summer_fees : "",
            },
            promo : {
                start_date: "",
                end_date: "",
                before_date: "",
                price: "",
                prices: "",
                christmas: "",
                min_weeks: "",
                combinable: "",
                promoPrice: ""
            },
            insurance : {
                weeks : "",
                price : "",
                prices : "",
            },
            airport : {
                arrival_name : "",
                arrival_price : "",
                departure_name : "",
                departure_price : "",
            },
            others : {
                currency : "",
                courier : "",
            },
            totals : {
                subTotal: "",
                subTotalSar: "",
                subSum1: "",
                subSum2: "",
                subSum3: "",
                guardAndChrisSum: "",
                custodianshipTotal: "",
                booksFeePrice: "",
            }

        };

        this.format = 'YYYY-MM-DD';

        this.mySelections = {
            country: false, 
            city: false,
            centre: false,
            course: false,
            course_addons: false,
            course_family: false,
            courseStart: false,
            courseWeeks: false,
            accommodation: false,
            accommodationWeeks: false,
            courierFee: false,
            Insurance: false,
            arrival: false,
            departure: false,
            discount_fixed: false,
            discount_registration_fee: false,
            discount_accommodation_fee: false,
            discount_arrival: false
        };

        this.subSum1T = {
            registrationFees: 0,
            bankCharges: 0,
            summerFee: 0, // = summerFee * weeks of summer
            coursePrice: 0, // = coursePrice * weeks  
            courseAddonsPrice: 0, // = courseAddonsPrice * weeks  
            courseFamilyPrice: 0, // = courseFamilyPrice
            courseExamPrice: 0, // = courseExamPrice
            courseProfessionalPrice: 0 // = courseProfessionalPrice
        };
        this.subSum2T = {
            accommodationFees: 0,
            accommodationSummerFees: 0, // = accommodationSummerFees * weeks of summer
            accommodationPrice: 0, // = accommodationPrice * weeks
            accommodationPromo: 0 // = accommodationPrice * weeks
        };
        this.subSum3T = {
            books: 0,
            courierFee: 0,
            insurance: 0, // = insurancePrice * courseWeeks
            arrival: 0,
            departure: 0
        };

        this.promo = {
            price: 0.00,
            christmas : 0,
            min_weeks: 0,
            use: '',
            start_date: '',
            end_date: '',
            before_date: '',
        };

        this.accommodation = {

            weeks:0,
            start_date: '',
            end_date: '',

            price: 0.00,
            discount: 0.00,
            percent: 0.00,

            prices: 0.00,

        }

        this.birthdayHelperDate = '2006-04-30';

        this.countryId = 0;
        this.countryName = '';
        
        this.cityId = 0;
        this.cityName = '';

        this.centreId = 0;
        this.regionId = 0;
        this.centreName = '';
        this.centreGuardianshipFee = 0;
        this.centreCustodianshipFee = 0;
        this.centreChristmasFee = 0;
        this.centreChristmasStart = '';
        this.centrechristmas_end = '';
        this.centreBooksFee = 0;
        this.centreBooksWeeks = 0;
        this.centreRegistrationFee = 0;
        this.centreBankCharges = 0;
        this.centreCurrencyId = 0;
        this.centreCurrencyName = '';
        this.centreCurrencyPrice = 0; // to SAR
        this.centreInsurance = 0;
        this.centreCourierFee = 0; // aramexfee
        this.centreAccommodationFee = 0;
        this.centreCourseSummerFee = 0;  // * courseWeeks (per month)
        this.centreCourseSummerFeeWeeksOff = '';  // * courseWeeks (per month)
        this.centreCourseSummerStart = '';
        this.centreCourseSummerEnds = '';
        this.centreCourseSummerNote = '';
        this.centreAirportArrivalId = 0; // airports
        this.centreAirportArrivalName = '';
        this.centreAirportArrivalPrice = 0;
        this.centreAirportDepartureId = 0;
        this.centreAirportDepartureName = '';
        this.centreAirportDeparturePrice = 0;

        this.courseId = 0;
        this.regionId = 0;
        this.courseName = '';
        this.couseType = 0;
        this.courseStart = '';
        this.courseWeeksText = '';
        this.courseWeeksNum = 0;
        this.courseDateFromTo = '';        
        this.coursePrice = 0;
        this.courseAddonsPrice = 0;
        this.courseFamilyPrice = 0;
        this.courseExamPrice = 0;
        this.courseProfessionalPrice = 0;
        this.courseProfessionalWeeks = 0;

        this.accommodationId = 0;
        this.accommodationName = '';
        this.accommodationWeeks = 0;
        this.accommodationPrice = 0;
        this.accommodationGuardianshipOn = 0;
        this.accommodationChristmasOn = 0;
        this.accommodationSummerFee = 0; // * accomodationWeeks
        this.accommodationSummerStart = '';
        this.accommodationSummerEnds = '';
        this.accommodationSummerNote = '';

        // discounts
        this.discountRegistrationFeeWaivedAfter  = 0; // discount
        this.discountAccommoFeeWaivedAfter = 0; // discount
        this.discountArrivalWaivedAfter = 0; // discount
        this.sumOfFixed_discountCourse = 0; // discount 
        this.sumOfFixed_discountTextCourse = ''; // fixed discount text for course
        this.sumOfFixed_discountAccommo = 0; // discount
        this.sumOfFixed_discountTextAccommo = ''; // fixed discount text for accommo
        
        // discounts text
        this.course_waived  = 0;
        this.course_discount_percent  = 0;
        this.accommo_waived  = 0;
        this.accommo_discount_percent  = 0;
    }
    cleanSum(ercase) {
        switch(ercase) {
            case 'country':
                for (let key in self.mySelections) {
                    self.mySelections.key= false;
                }
                self.printedBlock.style.visibility = 'hidden';
                self.FormCity.value = '';
                self.FormCenter.value = '';
                self.FormCourse.value = '';
                self.FormCourseAddons.value = '';
                self.FormCourseAddonsWeeks.value = '';
                self.FormCourseFamily.value = '';
                self.FormCourseFamilyWeeks.value = '';
                self.FormCourseExam.value = '';
                self.FormCourseExamWeeks.value = '';
                self.FormCourseExamDates.value = '';
                self.FormCourseSemesterStart.value = '';
                self.FormCourseNormalStart.value = '';
                self.FormCourseSemesterWeeks.value = '';
                self.FormCourseNormalWeeks.value = '';
                self.FormAccommodation.value = '';
                self.FormAccommodationWeeks.value = '';
                self.FormCourier.value = '';
                self.FormInsurance.value = '';
                self.FormArrival.value = '';
                self.FormDeparture.value = '';                
                self.FormCity.disabled = true;
                self.FormCenter.disabled = true;
                self.FormCourse.disabled = true;
                self.FormCourseSemesterStart.disabled = true;
                self.FormCourseNormalStart.disabled = true;
                self.FormCourseSemesterWeeks.disabled = true;
                self.FormCourseNormalWeeks.disabled = true;
                self.FormAccommodation.disabled = true;
                self.FormAccommodationWeeks.disabled = true;
                self.FormCourier.disabled = true;
                self.FormInsurance.disabled = true;
                self.FormArrival.disabled = true;
                self.FormDeparture.disabled = true;
                [...self.HolderSub1Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderSub2Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderSub3Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderTotal].map(element => element.innerText= '00.00'); 
                [...self.HolderTotalSAR].map(element => element.innerText= '00.00'); 
                [...self.HolderCountryName].map(element => element.innerText=''); 
                self.prtd_country.style.display = 'none';
                [...self.HolderCityName].map(element => element.innerText=''); 
                self.prtd_city.style.display = 'none';
                [...self.HolderCentreName].map(element => element.innerText = '');
                self.prtd_centre.style.display = 'none';
                [...self.HolderCourseName].map(element => element.innerText = ''); 
                self.prtd_course.style.display = 'none';
                [...self.HolderRegistrationFeeRow].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderBankChargesRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_registration_fees.style.display = 'none';
                self.prtd_bank_charges.style.display = 'none';
                [...self.HolderBooksRow].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderRegistrationFeeVal].map(element => element.innerText = '');
                [...self.HolderBankChargesVal].map(element => element.innerText = '');
                [...self.HolderBooksVal].map(element => element.innerText = ''); 
                self.prtd_books.style.display = 'none';
                [...self.HolderCourseWeeks].map(element => element.innerText = ''); 
                self.prtd_course_weeks.style.display = 'none';
                [...self.HolderCourseWeeksVal].map(element => element.innerText = '');
                [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_insurance.style.display = 'none';
                [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_summer_sup.style.display = 'none';
                [...self.HolderCourseStartDate].map(element => element.innerText = ''); 
                self.prtd_course_date.style.display = 'none';
                [...self.HolderInsuranceWeeks].map(element => element.innerText = ''); 
                [...self.HolderInsuranceVal].map(element => element.innerText = '');
                [...self.HolderAccommodationName].map(element => element.innerText = ''); 
                self.prtd_acco.style.display = 'none';
                [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_fees.style.display = 'none';
                [...self.HolderAccommodationFeeVal].map(element => element.innerText = ''); 
                [...self.HolderAccommodationWeeksVal].map(element => element.innerText = ''); 
                [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_sup.style.display = 'none';
                [...self.HolderAccommodationWeeks].map(element => element.innerText = ''); 
                [...self.HolderAramexRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_aramex.style.display = 'none';
                [...self.HolderAramexVal].map(element => element.innerText = ''); 
                [...self.HolderAirportRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_airport.style.display = 'none';
                [...self.HolderArrivalName].map(element => element.innerText = ''); 
                [...self.HolderDepartureName].map(element => element.innerText = ''); 
                [...self.HolderArrivalVal].map(element => element.innerText = ''); 
                [...self.HolderDepartureVal].map(element => element.innerText = ''); 
                self.countryId = 0;
                self.countryName = '';
                self.cityId = 0;
                self.cityName = '';
                self.centreId = 0;
                self.centreName = '';
                self.centreGuardianshipFee = 0;
                this.centreCustodianshipFee = 0;
                self.centreChristmasFee = 0;
                self.centreChristmasStart = '';
                self.centrechristmas_end = '';
                self.centreBooksFee = 0;
                self.centreBooksWeeks = 0;
                self.centreRegistrationFee = 0;
                self.centreBankCharges = 0;
                self.centreCurrencyId = 0;
                self.centreCurrencyName = '';
                self.centreCurrencyPrice = 0; 
                self.centreInsurance = 0;
                self.centreCourierFee = 0; 
                self.centreAccommodationFee = 0;
                self.centreCourseSummerFee = 0;  
                this.centreCourseSummerFeeWeeksOff = ''; 
                self.centreCourseSummerStart = '';
                self.centreCourseSummerEnds = '';
                self.centreCourseSummerNote = '';
                self.centreAirportArrivalId = 0; 
                self.centreAirportArrivalName = '';
                self.centreAirportArrivalPrice = 0;
                self.centreAirportDepartureId = 0;
                self.centreAirportDepartureName = '';
                self.centreAirportDeparturePrice = 0;
                self.courseId = 0;
                self.courseName = '';
                self.couseType = 0;
                self.courseStart = '';
                self.courseWeeksText = '';
                self.courseWeeksNum = 0;
                self.courseDateFromTo = '';        
                self.coursePrice = 0;
                self.courseAddonsPrice = 0;
                self.accommodationId = 0;
                self.accommodationName = '';
                self.accommodationWeeks = 0;
                self.accommodationPrice = 0;
                self.accommodationGuardianshipOn = 0;
                self.accommodationChristmasOn = 0;
                self.accommodationSummerFee = 0; 
                self.accommodationSummerStart = '';
                self.accommodationSummerEnds = '';
                self.accommodationSummerNote = '';
                
                self.pdf.country = {
                    id : "",
                    name : ""
                }
                self.pdf.city = {
                    id : "",
                    name : ""
                }
                self.pdf.centre = {
                    id : "",
                    name : "",
                    enrolment_fee : "",
                    bank_change : "",
                }
                self.pdf.course = {
                    id : "",
                    name : "",
                    start_date : "",
                    number_weeks : "",
                }
                break;
            case 'city':
                for (let key in self.mySelections) {
                    self.mySelections.key= false;
                }
                self.mySelections.country = true;
                self.FormCenter.value = '';
                self.FormCourse.value = '';
                self.FormCourseAddons.value = '';
                self.FormCourseAddonsWeeks.value = '';
                self.FormCourseFamily.value = '';
                self.FormCourseFamilyWeeks.value = '';
                self.FormCourseExam.value = '';
                self.FormCourseExamWeeks.value = '';
                self.FormCourseExamDates.value = '';
                self.FormCourseSemesterStart.value = '';
                self.FormCourseNormalStart.value = '';
                self.FormCourseSemesterWeeks.value = '';
                self.FormCourseNormalWeeks.value = '';
                self.FormAccommodation.value = '';
                self.FormAccommodationWeeks.value = '';
                self.FormCourier.value = '';
                self.FormInsurance.value = '';
                self.FormArrival.value = '';
                self.FormDeparture.value = '';
                self.FormCenter.disabled = true;
                self.FormCourse.disabled = true;
                self.FormCourseSemesterStart.disabled = true;
                self.FormCourseNormalStart.disabled = true;
                self.FormCourseSemesterWeeks.disabled = true;
                self.FormCourseNormalWeeks.disabled = true;
                self.FormAccommodation.disabled = true;
                self.FormAccommodationWeeks.disabled = true;
                self.FormCourier.disabled = true;
                self.FormInsurance.disabled = true;
                self.FormArrival.disabled = true;
                self.FormDeparture.disabled = true;
                [...self.HolderSub1Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderSub2Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderSub3Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderTotal].map(element => element.innerText= '00.00'); 
                [...self.HolderTotalSAR].map(element => element.innerText= '00.00'); 
                [...self.HolderCityName].map(element => element.innerText=''); 
                self.prtd_city.style.display = 'none';
                [...self.HolderCentreName].map(element => element.innerText = ''); 
                self.prtd_centre.style.display = 'none';
                [...self.HolderCourseName].map(element => element.innerText = ''); 
                self.prtd_course.style.display = 'none';
                [...self.HolderRegistrationFeeRow].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderBankChargesRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_registration_fees.style.display = 'none';
                self.prtd_bank_charges.style.display = 'none';
                [...self.HolderBooksRow].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderRegistrationFeeVal].map(element => element.innerText = ''); 
                [...self.HolderBankChargesVal].map(element => element.innerText = ''); 
                [...self.HolderBooksVal].map(element => element.innerText = ''); 
                self.prtd_books.style.display = 'none';
                [...self.HolderCourseWeeks].map(element => element.innerText = ''); 
                self.prtd_course_weeks.style.display = 'none';
                [...self.HolderCourseWeeksVal].map(element => element.innerText = '');
                [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_insurance.style.display = 'none';
                [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_summer_sup.style.display = 'none';
                [...self.HolderCourseStartDate].map(element => element.innerText = ''); 
                self.prtd_course_date.style.display = 'none';
                [...self.HolderInsuranceWeeks].map(element => element.innerText = ''); 
                [...self.HolderInsuranceVal].map(element => element.innerText = '');
                [...self.HolderAccommodationName].map(element => element.innerText = ''); 
                self.prtd_acco.style.display = 'none';
                [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_fees.style.display = 'none';
                [...self.HolderAccommodationFeeVal].map(element => element.innerText = ''); 
                [...self.HolderAccommodationWeeksVal].map(element => element.innerText = ''); 
                [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_sup.style.display = 'none';
                [...self.HolderAccommodationWeeks].map(element => element.innerText = ''); 
                [...self.HolderAramexRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_aramex.style.display = 'none';
                [...self.HolderAramexVal].map(element => element.innerText = ''); 
                [...self.HolderAirportRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_airport.style.display = 'none';
                [...self.HolderArrivalName].map(element => element.innerText = ''); 
                [...self.HolderDepartureName].map(element => element.innerText = ''); 
                [...self.HolderArrivalVal].map(element => element.innerText = ''); 
                [...self.HolderDepartureVal].map(element => element.innerText = ''); 
                self.cityId = 0;
                self.cityName = '';
                self.centreId = 0;
                self.centreName = '';
                self.centreBooksFee = 0;
                self.centreBooksWeeks = 0;
                self.centreGuardianshipFee = 0;
                this.centreCustodianshipFee = 0;
                self.centreChristmasFee = 0;
                self.centreChristmasStart = '';
                self.centrechristmas_end = '';
                self.centreRegistrationFee = 0;
                self.centreBankCharges = 0;
                self.centreCurrencyId = 0;
                self.centreCurrencyName = '';
                self.centreCurrencyPrice = 0; 
                self.centreInsurance = 0;
                self.centreCourierFee = 0; 
                self.centreAccommodationFee = 0;
                self.centreCourseSummerFee = 0;  
                this.centreCourseSummerFeeWeeksOff = ''; 
                self.centreCourseSummerStart = '';
                self.centreCourseSummerEnds = '';
                self.centreCourseSummerNote = '';
                self.centreAirportArrivalId = 0; 
                self.centreAirportArrivalName = '';
                self.centreAirportArrivalPrice = 0;
                self.centreAirportDepartureId = 0;
                self.centreAirportDepartureName = '';
                self.centreAirportDeparturePrice = 0;
                self.courseId = 0;
                self.courseName = '';
                self.couseType = 0;
                self.courseStart = '';
                self.courseWeeksText = '';
                self.courseWeeksNum = 0;
                self.courseDateFromTo = '';        
                self.coursePrice = 0;
                self.accommodationId = 0;
                self.accommodationName = '';
                self.accommodationWeeks = 0;
                self.accommodationPrice = 0;
                self.accommodationGuardianshipOn = 0;
                self.accommodationChristmasOn = 0;
                self.accommodationSummerFee = 0; 
                self.accommodationSummerStart = '';
                self.accommodationSummerEnds = '';
                self.accommodationSummerNote = '';
                
                self.pdf.city = {
                    id : "",
                    name : ""
                }
                self.pdf.centre = {
                    id : "",
                    name : "",
                    enrolment_fee : "",
                    bank_change : "",
                }
                self.pdf.course = {
                    id : "",
                    name : "",
                    start_date : "",
                    number_weeks : "",
                }
                break;
            case 'centre':
                for (let key in self.mySelections) {
                    self.mySelections.key= false;
                }
                self.mySelections.country = true;
                self.mySelections.city = true;
                self.FormCourse.value = '';
                self.FormCourseAddons.value = '';
                self.FormCourseAddonsWeeks.value = '';
                self.FormCourseExam.value = '';
                self.FormCourseExamWeeks.value = '';
                self.FormCourseExamDates.value = '';
                self.FormCourseSemesterStart.value = '';
                self.FormCourseNormalStart.value = '';
                self.FormCourseSemesterWeeks.value = '';
                self.FormCourseNormalWeeks.value = '';
                self.FormAccommodation.value = '';
                self.FormAccommodationWeeks.value = '';
                self.FormCourier.value = '';
                self.FormInsurance.value = '';
                self.FormArrival.value = '';
                self.FormDeparture.value = '';
                self.FormCourse.disabled = true;
                self.FormCourseAddons.disabled = true;
                self.FormCourseAddonsWeeks.disabled = true;
                self.FormCourseSemesterStart.disabled = true;
                self.FormCourseNormalStart.disabled = true;
                self.FormCourseSemesterWeeks.disabled = true;
                self.FormCourseNormalWeeks.disabled = true;
                self.FormAccommodation.disabled = true;
                self.FormAccommodationWeeks.disabled = true;
                self.FormCourier.disabled = true;
                self.FormInsurance.disabled = true;
                self.FormArrival.disabled = true;
                self.FormDeparture.disabled = true;
                [...self.HolderSub1Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderSub2Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderSub3Row].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderTotal].map(element => element.innerText= '00.00'); 
                [...self.HolderTotalSAR].map(element => element.innerText= '00.00'); 
                [...self.HolderCentreName].map(element => element.innerText = ''); 
                self.prtd_centre.style.display = 'none';
                [...self.HolderCourseName].map(element => element.innerText = ''); 
                self.prtd_course.style.display = 'none';
                [...self.HolderCourseAddonsName].map(element => element.innerText = ''); 
                self.prtd_course_addons.style.display = 'none';
                [...self.HolderCourseAddonsWeeks].map(element => element.innerText = ''); 
                self.prtd_course_weeks.style.display = 'none';
                [...self.HolderCourseAddonsPrice].map(element => element.innerText = ''); 
                [...self.HolderRegistrationFeeRow].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderBankChargesRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_registration_fees.style.display = 'none';
                self.prtd_bank_charges.style.display = 'none';
                [...self.HolderBooksRow].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderRegistrationFeeVal].map(element => element.innerText = ''); 
                [...self.HolderBankChargesVal].map(element => element.innerText = ''); 
                [...self.HolderBooksVal].map(element => element.innerText = ''); 
                self.prtd_books.style.display = 'none';
                [...self.HolderCourseWeeks].map(element => element.innerText = ''); 
                self.prtd_course_weeks.style.display = 'none';
                [...self.HolderCourseWeeksVal].map(element => element.innerText = '');
                [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_insurance.style.display = 'none';
                [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_summer_sup.style.display = 'none';
                [...self.HolderCourseStartDate].map(element => element.innerText = ''); 
                self.prtd_course_date.style.display = 'none';
                [...self.HolderInsuranceWeeks].map(element => element.innerText = ''); 
                [...self.HolderInsuranceVal].map(element => element.innerText = '');
                [...self.HolderAccommodationName].map(element => element.innerText = ''); 
                self.prtd_acco.style.display = 'none';
                [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_fees.style.display = 'none';
                [...self.HolderAccommodationFeeVal].map(element => element.innerText = ''); 
                [...self.HolderAccommodationWeeksVal].map(element => element.innerText = ''); 
                [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_sup.style.display = 'none';
                [...self.HolderAccommodationWeeks].map(element => element.innerText = ''); 
                [...self.HolderAramexRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_aramex.style.display = 'none';
                [...self.HolderAramexVal].map(element => element.innerText = ''); 
                [...self.HolderAirportRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_airport.style.display = 'none';
                [...self.HolderArrivalName].map(element => element.innerText = ''); 
                [...self.HolderDepartureName].map(element => element.innerText = ''); 
                [...self.HolderArrivalVal].map(element => element.innerText = ''); 
                [...self.HolderDepartureVal].map(element => element.innerText = ''); 
                self.centreId = 0;
                self.centreName = '';
                self.centreBooksFee = 0;
                self.centreBooksWeeks = 0;
                self.centreGuardianshipFee = 0;
                this.centreCustodianshipFee = 0;
                self.centreChristmasFee = 0;
                self.centreChristmasStart = '';
                self.centrechristmas_end = '';
                self.centreRegistrationFee = 0;
                self.centreBankCharges = 0;
                self.centreCurrencyId = 0;
                self.centreCurrencyName = '';
                self.centreCurrencyPrice = 0; 
                self.centreInsurance = 0;
                self.centreCourierFee = 0; 
                self.centreAccommodationFee = 0;
                self.centreCourseSummerFee = 0;  
                this.centreCourseSummerFeeWeeksOff = ''; 
                self.centreCourseSummerStart = '';
                self.centreCourseSummerEnds = '';
                self.centreCourseSummerNote = '';
                self.centreAirportArrivalId = 0; 
                self.centreAirportArrivalName = '';
                self.centreAirportArrivalPrice = 0;
                self.centreAirportDepartureId = 0;
                self.centreAirportDepartureName = '';
                self.centreAirportDeparturePrice = 0;
                self.courseId = 0;
                self.courseName = '';
                self.couseType = 0;
                self.courseStart = '';
                self.courseWeeksText = '';
                self.courseWeeksNum = 0;
                self.courseDateFromTo = '';        
                self.coursePrice = 0;
                self.courseAddonsPrice = 0;
                self.courseFamilyPrice = 0;
                self.accommodationId = 0;
                self.accommodationName = '';
                self.accommodationWeeks = 0;
                self.accommodationPrice = 0;
                self.accommodationGuardianshipOn = 0;
                self.accommodationChristmasOn = 0;
                self.accommodationSummerFee = 0; 
                self.accommodationSummerStart = '';
                self.accommodationSummerEnds = '';
                self.accommodationSummerNote = '';
                
                self.pdf.centre = {
                    id : "",
                    name : "",
                    enrolment_fee : "",
                    bank_change : "",
                }
                self.pdf.course = {
                    id : "",
                    name : "",
                    start_date : "",
                    number_weeks : "",
                }
                break;
        }

        // discount
        self.mySelections.discount_fixed = false;
        self.mySelections.discount_registration_fee = false;
        self.mySelections.discount_accommodation_fee = false;
        self.mySelections.discount_arrival = false;
        // remove discount text from calculator

        for (let key in self.subSum1T) {
            self.subSum1T[key] = 0;
        }
        for (let key in self.subSum2T) {
            self.subSum2T[key] = 0;
        }
        for (let key in self.subSum3T) {
            self.subSum3T[key] = 0;
        }
    };
    accommoMaxWeeks(maxWeeks) {
        console.log("accommoMaxWeeks .. ", maxWeeks);
        self.FormAccommodationWeeks.innerHTML = "";
        for(var i = maxWeeks; i >= 0; --i) {
            var option = document.createElement('option');
            if(i == 0) {
                option.value = '';
                option.selected = 'selected';
                option.text =  '- - Please Select - -';
            } else if(i == 1) {
                option.value = 1;
                option.text =  '1 week';
            } else {
                option.value = i;
                option.text =  i+' weeks';
            }
            self.FormAccommodationWeeks.add(option, 0);
        }
    };
    addonsMaxWeeks(maxWeeks) {
        console.log("accommoAddonsMaxWeeks .. ", maxWeeks);
        self.FormCourseAddonsWeeks.innerHTML = "";
        for(var i = maxWeeks; i >= 0; --i) {
            var option = document.createElement('option');
            if(i == 0) {
                option.value = '';
                option.selected = 'selected';
                option.text =  '- - Please Select - -';
            /*} else if(i == 1) {
                option.value = 1;
                option.text =  '1 Time';*/
            } else {
                option.value = i;
                option.text =  'Addon x ' + i;
            }
            self.FormCourseAddonsWeeks.add(option, 0);
        }
    };  
    familyMaxWeeks(maxWeeks) {
        console.log("familyMaxWeeks .. ", maxWeeks);
        self.FormCourseFamilyWeeks.innerHTML = "";
        for(var i = maxWeeks; i >= 0; --i) {
            var option = document.createElement('option');
            if(i == 0) {
                option.value = '';
                option.selected = 'selected';
                option.text =  '- - Please Select - -';
            } else if(i == 1) {
                option.value = 1;
                option.text =  '1 week';
            } else {
                option.value = i;
                option.text =  i + ' weeks';
            }
            self.FormCourseFamilyWeeks.add(option, 0);
        }
    };    
    intersectDateRanges(dates) {
        dates = dates.map(function(v,i,a){
          var start = moment(v[0],self.format).startOf('day');
          var end = moment(v[1],self.format).endOf('day');
          return [start,end];
        });
        dates.sort(function(a,b){
          if(a[0].isBefore(b[0])) return -1;
          if(a[0].isAfter(b[0])) return 1;
          return 0;
        });
        var range = dates[0].slice(0);
        for(var i = 1; i < dates.length; i++) {
          if(dates[i][0].isAfter(range[1])) return null;
          range[0] = dates[i][0];
          if(dates[i][1].isBefore(range[1])) {
            range[1] = dates[i][1];
          }
        }
        return range;
    }
    rangeToWeeks(range){
        if(!range) return NaN;
        return moment.duration(range[1] - range[0]).asWeeks();
    }
    calculAccommodationSummerFees() {
        let asummerfee = 0;
        // if(self.couseType) { // if acadimec course
        //     asummerfee = 0;
        // } else {
            const mendsdate = moment(self.courseStart, 'YYYY-MM-DD').add(self.accommodationWeeks, 'w').format('YYYY-MM-DD')
            var dates = [
                [self.courseStart,mendsdate],
                [self.accommodationSummerStart,self.accommodationSummerEnds]
            ];
            const weeksIntersect = Math.floor(self.rangeToWeeks(self.intersectDateRanges(dates)));
            if (!isNaN(weeksIntersect)) {
                if( weeksIntersect != 0) {
                    asummerfee = weeksIntersect * self.accommodationSummerFee;
                } else {
                    asummerfee = 0;
                }
            } else {
                asummerfee = 0;
            }
        //}
        if(asummerfee!=0) {
            [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'visible'); 
            self.prtd_acco_sup.style.display = 'table-row';
            [...self.HolderAccoSummerPrice].map(element => element.innerText = asummerfee); 
//            [...self.HolderAccoSummerPrice].map(element => element.innerText = self.centreCurrencyName+' '+asummerfee); 
            [...self.HolderAccoSummerNot].map(element => element.innerText = self.accommodationSummerNote); 
        } else {
            [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'hidden'); 
            self.prtd_acco_sup.style.display = 'none';
        }
        return asummerfee;
    }
    calculCourseSummerFees() {

        if(self.centreCourseSummerFeeWeeksOff != '')
            if(self.courseWeeksNum >= parseInt(self.centreCourseSummerFeeWeeksOff)) {
                [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_summer_sup.style.display = 'none';
                return 0;
            }

        

        let asummerfee = 0;        
        if(self.couseType) { // if acadimec course
            asummerfee = 0;
        } else {
            const mendsdate = moment(self.courseStart, 'YYYY-MM-DD').add(self.courseWeeksNum, 'w').format('YYYY-MM-DD')
            var dates = [
                [self.courseStart,mendsdate],
                [self.centreCourseSummerStart,self.centreCourseSummerEnds]
            ];
            const weeksIntersect = Math.floor(self.rangeToWeeks(self.intersectDateRanges(dates)));
            if (!isNaN(weeksIntersect)) {
                if( weeksIntersect != 0) {
                    asummerfee = weeksIntersect * self.centreCourseSummerFee;

        // console.log('summer fees are calculated = '+asummerfee);
        // console.log('weeksIntersect = '+weeksIntersect);
        // console.log('self.centreCourseSummerFee = '+self.centreCourseSummerFee);

                } else {
                    asummerfee = 0;
                }
            } else {
                asummerfee = 0;
            }
        }


        if(asummerfee!=0) {
            [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'visible'); 
            self.prtd_course_summer_sup.style.display = 'table-row';
            [...self.HolderCourseSummerPrice].map(element => element.innerText = asummerfee); 
           // [...self.HolderCourseSummerPrice].map(element => element.innerText = self.centreCurrencyName+' '+asummerfee); 
            [...self.HolderCourseSummerNot].map(element => element.innerText = self.centreCourseSummerNote); 
        } else {
            [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
            self.prtd_course_summer_sup.style.display = 'none';
        }
        return asummerfee;
    }
    calculateWeeks(startDate, endDate) {
        // تحويل التواريخ إلى كائنات Date
        const start = new Date(startDate);
        const end = new Date(endDate);
        
        // الحصول على يوم الأسبوع (0 = الأحد, 1 = الاثنين, ... 6 = السبت)
        const startDay = start.getDay();
        const endDay = end.getDay();
        
        // إذا كانت البداية ليست يوم الاثنين (نقلها إلى أقرب يوم اثنين)
        const startMondayOffset = (startDay === 0) ? -6 : 1 - startDay; // إذا كان الأحد (0) نعود 6 أيام للوصول إلى الاثنين
        const endMondayOffset = (endDay === 0) ? -6 : 1 - endDay; // إذا كان الأحد (0) نعود 6 أيام للوصول إلى الاثنين
        
        // تعديل التواريخ لتكون بداية الأسبوع يوم الاثنين
        const adjustedStart = new Date(start);
        adjustedStart.setDate(start.getDate() + startMondayOffset);
        
        const adjustedEnd = new Date(end);
        adjustedEnd.setDate(end.getDate() + endMondayOffset);
        
        // حساب الفرق بين التاريخين بالأيام
        const timeDifference = adjustedEnd - adjustedStart;
        
        // تحويل الفرق من ميللي ثانية إلى أيام ثم إلى أسابيع
        const daysDifference = timeDifference / (1000 * 3600 * 24);

        // حساب الفرق بالقيمة المطلقة للأيام
        const absoluteDaysDifference = Math.abs(daysDifference);

        const weeksDifference = Math.floor(absoluteDaysDifference / 7);
        
        return weeksDifference;
    }
}

class MyTextHolders extends MyConstractor {
    constructor() {
        super();
        //document.getElementById("mySelect").disabled = true; 
        // form selects names 
        this.printedBlock = document.getElementById("printedBlock");
        this.accwkstmd = document.getElementById("accwkstmd");
        this.FormCountry = document.getElementById("slc_county");
        this.FormCity = document.getElementById("slc_city");
        this.FormCenter = document.getElementById("slc_centre");
        this.FormCourse = document.getElementById("slc_course");
        this.FormCourseAddons = document.getElementById("slc_course_addons");
        this.FormCourseAddonsWeeks = document.getElementById("slc_course_addons_weeks");
        this.FormCourseAddonsStart = document.querySelector(".course_addons_start");

        this.FormCourseFamily = document.getElementById("slc_course_family");
        this.FormCourseFamilyWeeks = document.getElementById("slc_course_family_weeks");

        this.FormCourseExam = document.getElementById("slc_course_exam");
        this.FormCourseExamDates = document.getElementById("slc_course_exam_dates");
        this.FormCourseExamWeeks = document.getElementById("slc_course_exam_weeks");

        this.FormCourseProfessional = document.getElementById("slc_course_professional");
        this.FormCourseProfessionalDates = document.getElementById("slc_course_professional_dates");

        this.FormCourseSemesterStart  = document.getElementById("datepickersemester");
        this.FormCourseNormalStart = document.getElementById("datepicker-autoclose");
        this.FormStudentAge = document.getElementById("studentage");
        this.FormCourseSemesterWeeks = document.getElementById("slc_couse_weeks");
        this.FormCourseNormalWeeks = document.getElementById("slc_couse_weeks2");
        this.FormAccommodation = document.getElementById("slc_accommodation");
        this.FormAccommodationWeeks = document.getElementById("slc_acco_weeks");
        this.FormCourier = document.getElementById("slc_aramex");
        this.FormInsurance = document.getElementById("slc_insurance");
        this.FormArrival = document.getElementById("slc_airport_arr");
        this.FormDeparture = document.getElementById("slc_airport_dep");
        // right side text holders
        this.HolderCountryName = document.getElementsByClassName("cal_country_name"); 
        this.HolderCityName = document.getElementsByClassName("cal_city_name");   
        this.HolderCentreName = document.getElementsByClassName("cal_centre_name"); 
        this.HolderBooksRow = document.getElementsByClassName("booksRow"); 
        this.HolderBooksVal = document.getElementsByClassName("cal_books_price"); 
        this.HolderRegistrationFeeRow = document.getElementsByClassName("registrationFeeRow"); 
        this.HolderBankChargesRow = document.getElementsByClassName("bankChargesRow"); 
        this.HolderRegistrationFeeVal = document.getElementsByClassName("registrationFeeVal"); 
        this.HolderBankChargesVal = document.getElementsByClassName("bankChargesVal"); 
        this.HolderCourseName = document.getElementsByClassName("cal_course_name");  
        this.HolderCourseAddonsName = document.getElementsByClassName("cal_course_addons_name");  
        this.HolderCourseAddonsWeeks = document.getElementsByClassName("cal_course_addons_weeks");  
        this.HolderCourseAddonsPrice = document.getElementsByClassName("cal_course_addons_price");  
        
        this.HolderCourseFamilyName = document.getElementsByClassName("cal_course_family_name");  
        this.HolderCourseFamilyPrice = document.getElementsByClassName("cal_course_family_price");  
        
        this.HolderCourseExamName = document.getElementsByClassName("cal_course_exam_name");  
        this.HolderCourseExamWeeks = document.getElementsByClassName("cal_course_exam_weeks");  
        this.HolderCourseExamPrice = document.getElementsByClassName("cal_course_exam_price");  
        
        this.HolderCourseProfessionalName = document.getElementsByClassName("cal_course_professional_name");  
        this.HolderCourseProfessionalWeeks = document.getElementsByClassName("cal_course_professional_weeks");  
        this.HolderCourseProfessionalPrice = document.getElementsByClassName("cal_course_professional_price");  
        
        this.HolderCourseStartDate = document.getElementsByClassName("cal_course_date"); 
        this.HolderCourseWeeks = document.getElementsByClassName("cal_course_weeks"); 
        this.HolderCourseWeeksVal = document.getElementsByClassName("cal_course_weeks_price"); 
        this.HolderCourseSummerBlock = document.getElementsByClassName("summerblock");  
        this.HolderCourseSummerNot = document.getElementsByClassName("cal_summer_note");  
        this.HolderCourseSummerPrice = document.getElementsByClassName("cal_summer_supp_price");  
        this.HolderAccoSummerBlock = document.getElementsByClassName("accoSummerblock");  
        this.HolderAccoSummerNot = document.getElementsByClassName("ccal_summer_note");  
        this.HolderAccoSummerPrice = document.getElementsByClassName("ccal_summer_supp_price"); 
        this.HolderAccommodationName = document.getElementsByClassName("cal_acco_name"); 
        this.HolderAccommodationWeeks = document.getElementsByClassName("cal_acco_weeks"); 
        this.HolderAccommodationWeeksVal = document.getElementsByClassName("cal_acco_weeks_price"); 
        this.HolderAccommodationFeeRow = document.getElementsByClassName("accommodationFeeRow"); 
        this.HolderAccommodationFeeVal = document.getElementsByClassName("cal_acco_fee_price"); 
        this.HolderDscAccommoFeePromoText = document.getElementsByClassName("cal_acco_fee_promo"); 
        this.HolderDscAccommoFeePromoValue = document.getElementsByClassName("cal_acco_fee_promo_price"); 
        this.HolderAramexRow = document.getElementsByClassName("aramexRow"); 
        this.HolderAramexVal = document.getElementsByClassName("cal_aramex_price"); 
        this.HolderInsuranceRow = document.getElementsByClassName("insuranceRow"); 
        this.HolderInsuranceWeeks = document.getElementsByClassName("cal_insurance"); 
        this.HolderInsuranceVal = document.getElementsByClassName("cal_insurance_price"); 
        this.HolderAirportRow = document.getElementsByClassName("airportRow"); 
        this.HolderArrivalName = document.getElementsByClassName("cal_airp_arr"); 
        this.HolderArrivalVal = document.getElementsByClassName("cal_airp_arr_price"); 
        this.HolderDepartureName = document.getElementsByClassName("cal_airp_dep"); 
        this.HolderDepartureVal = document.getElementsByClassName("cal_airp_dep_price"); 
        this.HolderGuardianshipFeeRow = document.getElementById("guardianshipFeeRow"); 
        this.HolderGuardianshipFeeRowPdf = document.getElementById("guardianshipFeeRowPdf"); 
        this.Holdercal_acco_guardianship_fee_price = document.getElementsByClassName("cal_acco_guardianship_fee_price"); 
        this.HolderCustodianshipFeeRow = document.getElementById("custodianshipFeeRow"); 
        this.HolderCustodianshipFeeRowPdf = document.getElementById("custodianshipFeeRowPdf"); 
        this.Holdercal_custodianship_fee_price = document.getElementsByClassName("cal_custodianship_fee_price"); 
        this.HolderChristmasRow = document.getElementById("christmasRow"); 
        this.HolderChristmasRowPdf = document.getElementById("christmasRowPdf"); 
        this.Holdercal_cal_acco_christmas_price = document.getElementsByClassName("cal_acco_christmas_price"); 
        // discount
        this.HolderDscCourse = document.getElementsByClassName("HolderDscCourse"); 
        this.HolderDscRegistrationFee = document.getElementsByClassName("HolderDscRegistrationFee"); 
        this.HolderDscAccommoFee = document.getElementsByClassName("HolderDscAccommoFee"); 
        this.HolderDscAccommoFeePromo = document.getElementsByClassName("HolderDscAccommoFeePromo"); 
        this.HolderDscCourseFixed = document.getElementsByClassName("HolderDscCourseFixed"); 
        this.HolderDscAccommo = document.getElementsByClassName("HolderDscAccommo"); 
        this.HolderDscAccommoFixed = document.getElementsByClassName("HolderDscAccommoFixed"); 
        this.HolderDscArrival = document.getElementsByClassName("HolderDscArrival"); 
        this.HolderDscCourseAmount = document.getElementsByClassName("HolderDscCourseAmount"); 
        this.HolderDscAccommoAmount = document.getElementsByClassName("HolderDscAccommoAmount"); 
        this.HolderDscCourseFixedAmount = document.getElementsByClassName("HolderDscCourseFixedAmount"); 
        this.HolderDscAccommoFixedAmount = document.getElementsByClassName("HolderDscAccommoFixedAmount"); 
        this.HolderDscCourseFixedText = document.getElementsByClassName("HolderDscCourseFixedText"); 
        this.HolderDscCourseText = document.getElementsByClassName("HolderDscCourseText"); 
        this.HolderDscAccommoText = document.getElementsByClassName("HolderDscAccommoText"); 
        this.HolderDscAccommoFixedText = document.getElementsByClassName("HolderDscAccommoFixedText"); 

        // subs + totals
        this.HolderSub1Row = document.getElementsByClassName("sub1Row"); 
        this.HolderSub1Val = document.getElementsByClassName("sub1Val"); 
        this.HolderSub2Row = document.getElementsByClassName("sub2Row"); 
        this.HolderSub2Val = document.getElementsByClassName("sub2Val"); 
        this.HolderSub3Row = document.getElementsByClassName("sub3Row"); 
        this.HolderSub3Val = document.getElementsByClassName("sub3Val"); 
        this.HolderTotal = document.getElementsByClassName("fnltotal"); 
        this.HolderTotalSAR = document.getElementsByClassName("fnltotalsar"); 
        // printed doc
        this.prtd_country = document.getElementById("prtd_country"); 
        this.prtd_city = document.getElementById("prtd_city"); 
        this.prtd_centre = document.getElementById("prtd_centre"); 
        this.prtd_course = document.getElementById("prtd_course"); 
        this.prtd_course_date = document.getElementById("prtd_course_date"); 
        this.prtd_course_weeks = document.getElementById("prtd_course_weeks"); 
        this.prtd_course_addons = document.getElementById("prtd_course_addons"); 
        this.prtd_course_family = document.getElementById("prtd_course_family"); 
        this.prtd_course_exam = document.getElementById("prtd_course_exam"); 
        this.prtd_course_professional = document.getElementById("prtd_course_professional"); 
        this.prtd_course_summer_sup = document.getElementById("prtd_course_summer_sup"); 
        this.prtd_registration_fees = document.getElementById("prtd_registration_fees"); 
        this.prtd_bank_charges = document.getElementById("prtd_bank_charges"); 
        this.prtd_books = document.getElementById("prtd_books"); 
        this.prtd_aramex = document.getElementById("prtd_aramex"); 
        this.prtd_insurance = document.getElementById("prtd_insurance"); 
        this.prtd_acco = document.getElementById("prtd_acco"); 
        this.prtd_acco_sup = document.getElementById("prtd_acco_sup"); 
        this.prtd_acco_fees = document.getElementById("prtd_acco_fees"); 
        this.prtd_airport = document.getElementById("prtd_airport"); 

        this.file_link = document.getElementById("file_link"); 
    }
}

class MyHelpers extends MyTextHolders {

    constructor() {
        super();
    }

    formatDate(date) {
        var monthNames = [
          "01", "02", "03",
          "04", "05", "06", "07",
          "08", "09", "10",
          "11", "12"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return year + '-' + monthNames[monthIndex] + '-' + day;

    }
    add_weeks(dt, n) {

        return new Date(dt.setDate(dt.getDate() + (n * 7)-3)); 
    }
    smster_datepicker( onlyThisDates) {
        $('#datepickersemester').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            beforeShowDay: function (date) {
                var dt_ddmmyyyy = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                if (onlyThisDates.indexOf(dt_ddmmyyyy) != -1) {
                    return {
                        classes: 'active'
                    };
                } else {
                    return false;
                }
            }
        });
    }

    parseDate(dateString) {
        return new Date(dateString).getTime();
    }

    calculatePromoPrice(accommodation, promo) {
        console.log("Calculate Promo Price .........");

        const startDate = self.parseDate(accommodation.start_date); // تاريخ بدء الحجز
        const endDate = self.parseDate(accommodation.end_date); // تاريخ انتهاء الحجز
        const promoStartDate = self.parseDate(promo.start_date); // تاريخ بداية العرض
        const promoEndDate = self.parseDate(promo.end_date); // تاريخ نهاية العرض

        let totalBeforePromo = 0; // المبلغ قبل العرض الترويجي
        let totalDuringPromo = 0; // المبلغ أثناء العرض الترويجي
        let totalAfterPromo = 0; // المبلغ بعد العرض الترويجي

        let weeksBeforePromo = 0; 
        let weeksDuringPromo = 0; 
        let weeksAfterPromo = 0; 

        let totalDiscount = 0;

        // حساب الفترة قبل العرض الترويجي
        if (startDate < promoStartDate) {
            const beforePromoEnd = Math.min(promoStartDate, endDate); // نهاية الفترة قبل العرض
            weeksBeforePromo = Math.ceil((beforePromoEnd - startDate) / (7 * 24 * 60 * 60 * 1000)); // حساب عدد الأسابيع قبل العرض
            totalBeforePromo = weeksBeforePromo * accommodation.price; // حساب المبلغ قبل العرض
        }

        let totalWithoutPromo = 0;
        // حساب الفترة أثناء العرض الترويجي
        if (endDate > promoStartDate && startDate < promoEndDate) {
            const duringPromoStart = Math.max(promoStartDate, startDate); // بداية الفترة أثناء العرض
            const duringPromoEnd = Math.min(promoEndDate, endDate); // نهاية الفترة أثناء العرض
            weeksDuringPromo = Math.ceil((duringPromoEnd - duringPromoStart) / (7 * 24 * 60 * 60 * 1000)); // حساب عدد الأسابيع أثناء العرض
           
            totalWithoutPromo = weeksDuringPromo * accommodation.price;
            if(accommodation.weeks >= promo.min_weeks){
                if(promo.combinable == "1"){
                    let discountedPricePerWeek = accommodation.price - promo.christmas;// حساب السعر المخفض للأسبوع
                    totalDuringPromo = weeksDuringPromo * discountedPricePerWeek;// حساب المبلغ أثناء العرض
                }else if(promo.combinable == "2"){
                    totalDuringPromo = weeksDuringPromo * promo.price;// حساب المبلغ أثناء العرض
                }else if(promo.combinable == "3"){
                    let discountedPricePerWeek = promo.price - promo.christmas;// حساب السعر المخفض للأسبوع
                    totalDuringPromo = weeksDuringPromo * discountedPricePerWeek;// حساب المبلغ أثناء العرض
                }else{
                    console.log("Combination not found");
                }
            }else{
                console.log("Minimum number of weeks is not met");
            }
        }else{
            console.log("The selected date range does not overlap with the promo period");
        }

        // حساب الفترة بعد العرض الترويجي
        if (endDate > promoEndDate) {
            const afterPromoStart = Math.max(promoEndDate, startDate); // بداية الفترة بعد العرض
            const afterPromoEnd = endDate; // نهاية الفترة بعد العرض
            weeksAfterPromo = Math.ceil((afterPromoEnd - afterPromoStart) / (7 * 24 * 60 * 60 * 1000)); // حساب عدد الأسابيع بعد العرض
            totalAfterPromo = weeksAfterPromo * accommodation.price; // حساب المبلغ بعد العرض
        }
        

        totalDiscount = totalWithoutPromo - totalDuringPromo;

        const totalResult = totalBeforePromo + totalDuringPromo + totalAfterPromo;

        const data = {
            accommodation: self.accommodation,
            promo: self.promo,
            weeks: {
                before : weeksBeforePromo,
                during : weeksDuringPromo,
                after : weeksAfterPromo,
            },
            total: {
                before : totalBeforePromo,
                during : totalDuringPromo,
                after : totalAfterPromo,
                without : totalWithoutPromo,
                discount : totalDiscount,
                result : totalResult,
            }
        }
        
        console.log(data);
        console.log("..............................");

        return totalDiscount;
    }

}

class MyForm extends MyHelpers {

    constructor() {
        super();
    }
    
    birthdayHelperOn(sel) {        
        return new Promise((resolve, reject) => {
            if(sel.value) {
                self.FormCountry.disabled = false;
                self.birthdayHelperDate= sel.value;
                self.ageHelper= sel.value;
                resolve();
            } else {
                self.birthdayHelperDate= '';
                self.ageHelper = '';
                self.FormCountry.disabled = true;
                resolve();
            }
        });
    }

    regionOn(sel) {
        self.cleanSum('country');
        return new Promise((resolve, reject) => {
            if(sel.value) {
                self.regionId = sel.value;
                self.FormCountry.disabled = false;
                self.pdf.region = {
                    id : sel.value,
                    name : sel.options[sel.selectedIndex].text
                }
            } else {
                self.regionId = 0;
                self.FormCountry.disabled = true;
                self.pdf.region = {
                    id : "",
                    name : ""
                }
            }
            self.FormCountry.value = '';
            resolve();
        })
    }

    countryOn(sel) {
        self.cleanSum('country');
        return new Promise((resolve, reject) => {
            if(sel.value) {
                self.countryName = sel.options[sel.selectedIndex].text;
                self.mySelections.country = true; 
                self.pdf.country = {
                    id : sel.value,
                    name : sel.options[sel.selectedIndex].text
                }
                axios.get(base_url+'fees/fees_get_city', {
                    params: {
                        country_id: sel.value
                    }
                })
                .then(function (response) {      
                    [...self.HolderCountryName].map(element => element.innerText= self.countryName); 
                    self.prtd_country.style.display = 'table-row';     
                    self.FormCity.innerHTML = response.data.cities;
                    self.FormCity.disabled = false;
                    self.countryId = sel.value;
                    self.printedBlock.style.visibility = 'visible';
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.pdf.country = {
                    id : "",
                    name : ""
                }
                self.mySelections.country = false;
                resolve();
            }
        });
    }

    cityOn(sel) {
        self.cleanSum('city');
        return new Promise((resolve, reject) => {
            if(sel.value) {
                self.mySelections.city = true;
                self.pdf.city = {
                    id : sel.value,
                    name : sel.options[sel.selectedIndex].text
                }
                axios.get(base_url+'fees/fees_get_centre', {
                    params: {
                        city_id: sel.value
                    }
                })
                .then(function (response) {
                    [...self.HolderCityName].map(element => element.innerText=sel.options[sel.selectedIndex].text); 
                    self.prtd_city.style.display = 'table-row';
                    self.FormCenter.innerHTML = response.data.centres;
                    self.FormCenter.disabled = false;
                    self.cityId = sel.value;
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.mySelections.city = false;
                resolve()
            }
        })
    }
    
    centreOn(sel) {
        self.cleanSum('centre');
        return new Promise((resolve, reject) => {
            if(sel.value) {
                self.mySelections.centre = true;
                axios.get(base_url+'fees/fees_get_center', {
                    params: {
                        centre_id: sel.value
                    }
                })
                .then(function (response) {

                    [...self.HolderCentreName].map(element => element.innerText = sel.options[sel.selectedIndex].text); 
                    self.prtd_centre.style.display = 'table-row';
                    [...self.HolderRegistrationFeeRow].map(element => element.style.visibility = 'visible');
                    [...self.HolderBankChargesRow].map(element => element.style.visibility = 'visible'); 
                    [...self.HolderBooksRow].map(element => element.style.visibility = 'visible'); 
                    self.prtd_registration_fees.style.display = 'table-row';
                    self.prtd_bank_charges.style.display = 'table-row';
                    
                    self.centreGuardianshipFee = response.data.school_info['guardianship_fee']; 
                    self.centreCustodianshipFee = response.data.school_info['custodianship_fee']; 
                    self.centreChristmasFee = response.data.school_info['christmas_fee']; 
                    self.centreChristmasStart = response.data.school_info['christmas_start']; 
                    self.centrechristmas_end = response.data.school_info['christmas_end']; 

                    self.centreAccommodationFee = response.data.school_info['accommodation_fee']; 
                    self.centreCourierFee = response.data.school_info['aramix_fee']; 
                    self.centreInsurance = response.data.school_info['insurance']; 
                    self.centreCurrencyName = response.data.currency_info['name'];
                    self.centreCurrencyPrice = response.data.currency_info['sar_price'];
                    self.centreRegistrationFee = response.data.school_info['registration_fee'];
                    self.centreBankCharges = response.data.school_info['bank_charges'];
                    self.centreBooksFee = response.data.school_info['books_fee'];
                    self.centreBooksWeeks = response.data.school_info['books_weeks'];
                    self.centreCourseSummerStart = response.data.school_info['smr_s_dt_start'];
                    self.centreCourseSummerEnds = response.data.school_info['smr_s_dt_ends'];
                    self.centreCourseSummerFee = response.data.school_info['summer_fees']; // * weeks num
                    self.centreCourseSummerFeeWeeksOff = response.data.school_info['summer_supp_week_off']; 
                    self.centreCourseSummerNote = response.data.school_info['smr_s_note'];
                    
                    [...self.HolderRegistrationFeeVal].map(element => element.innerText = self.centreRegistrationFee); 
                    [...self.HolderBankChargesVal].map(element => element.innerText = self.centreBankCharges); 
                    //[...self.HolderRegistrationFeeVal].map(element => element.innerText = self.centreCurrencyName+' '+self.centreRegistrationFee); 
                    //[...self.HolderBooksVal].map(element => element.innerText = self.centreBooksFee); 
                    //[...self.HolderBooksVal].map(element => element.innerText = self.centreCurrencyName+' '+self.centreBooksFee); 
                    self.prtd_books.style.display = 'table-row';

                    self.FormCourse.innerHTML = response.data.courses;   
                    self.FormCourseAddons.innerHTML = response.data.courses_addons;   
                    self.FormCourseFamily.innerHTML = response.data.courses_family;   
                    self.FormCourseExam.innerHTML = response.data.courses_exam;   
                    self.FormCourseProfessional.innerHTML = response.data.courses_professional;   
                    self.FormAccommodation.innerHTML = response.data.accommodation; 
                    self.FormArrival.innerHTML = response.data.airports_arr; 
                    self.FormDeparture.innerHTML = response.data.airports_dep; 

                    self.FormCourse.disabled = false;
                    self.FormCourseAddons.disabled = false;
                    self.FormCourseFamily.disabled = false;
                    self.FormCourseExam.disabled = false;
                    self.FormCourseProfessional.disabled = false;
                    self.FormAccommodation.disabled = false;
                    self.FormAccommodationWeeks.disabled = false;
                    self.FormArrival.disabled = false;
                    self.FormDeparture.disabled = false;

                    self.FormInsurance.disabled = false;
                    self.FormCourier.disabled = false;

                    self.courseId = sel.value;

                    [...self.HolderSub1Row].map(element => element.style.visibility = 'visible'); 
                    [...self.HolderSub2Row].map(element => element.style.visibility = 'visible'); 
                    [...self.HolderSub3Row].map(element => element.style.visibility = 'visible'); 

                    // SET SUM

                    // 27-11-2022 
                    // FROM
                    // self.subSum1T.registrationFees = parseInt(self.centreRegistrationFee, 10) + parseInt(self.centreBankCharges, 10);
                    // TO:
                    self.subSum1T.registrationFees = parseInt(self.centreRegistrationFee, 10); 
                    self.subSum1T.bankCharges =  parseInt(self.centreBankCharges, 10);
                    // TO-END


                    self.pdf.centre = {
                        id : sel.value,
                        name : sel.options[sel.selectedIndex].text,
                        enrolment_fee : self.subSum1T.registrationFees,
                        bank_change : self.subSum1T.bankCharges,
                    };


                    //self.subSum3T.books = self.booksFeeSum();
                    
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.mySelections.centre = false;
                resolve();
            }
        })
    }

    courseOn(sel) { 
        //this.addonsMaxWeeks(0);
        
        self.subSum2T.accommodationPromo = 0;
        [...self.HolderDscAccommoFeePromo].map(element => element.style.visibility = 'hidden');
        [...self.HolderDscAccommoFeePromoText].map(element => element.innerText = '');
        [...self.HolderDscAccommoFeePromoValue].map(element => element.innerText = '');

        return new Promise((resolve, reject) => {

            // discount
            self.mySelections.discount_fixed = false;
            self.mySelections.discount_registration_fee = false;
            self.mySelections.discount_accommodation_fee = false;
            self.mySelections.discount_arrival = false;

            if(sel.value) {
                self.mySelections.course = true;
                self.courseId = sel.value;
                
                axios.get(base_url+'fees/fees_get_course_info', { 
                    params: {
                        course_id: sel.value,
                        region_id: self.regionId
                    }
                })

                .then(function (response) {
                    [...self.HolderCourseName].map(element => element.innerText = sel.options[sel.selectedIndex].text); 
                    self.prtd_course.style.display = 'table-row';
                    self.FormCourseSemesterStart.disabled = false;
                    self.FormCourseNormalStart.disabled = false;
                    self.couseType = parseInt(response.data.course_info['type'], 10); 
                    if (self.couseType == 0) {
                        self.accwkstmd.style.display = 'none';
                        self.FormCourseSemesterStart.setAttribute("name", "date2");
                        self.FormCourseSemesterStart.style.display = 'none';
                        self.FormCourseNormalStart.setAttribute("name", "date");
                        self.FormCourseNormalStart.style.display = 'block';
                        self.FormCourseNormalWeeks.setAttribute("name", "slc_couse_weeks2");
                        self.FormCourseNormalWeeks.style.display = 'none';
                        self.FormCourseSemesterWeeks.setAttribute("name", "slc_couse_weeks");
                        self.FormCourseSemesterWeeks.style.display = 'block';

                    } else {
                        self.accwkstmd.style.display = 'block';
                        self.FormCourseSemesterStart.setAttribute("name", "date");
                        self.FormCourseSemesterStart.style.display = 'block';
                        self.FormCourseNormalStart.setAttribute("name", "date2");
                        self.FormCourseNormalStart.style.display = 'none';
                        self.smster_datepicker(response.data.course_info['start'].split(',')); 
                        let selectdrp = '<option value="" selected="selected">- - Please Select - -</option>';
                        $.each(response.data.course_price_info, function(key,val) {
                        selectdrp +='<option value="'+val["ends"]+'">'+val["ends"]+' weeks</option>';
                        });
                        self.FormCourseSemesterWeeks.setAttribute("name", "slc_couse_weeks2");
                        self.FormCourseSemesterWeeks.style.display = 'none';
                        self.FormCourseNormalWeeks.setAttribute("name", "slc_couse_weeks");
                        self.FormCourseNormalWeeks.innerHTML = selectdrp;
                        self.FormCourseNormalWeeks.style.display = 'block';                    
                    } 
                    if(self.mySelections.courseWeeks) {
                        [...self.HolderCourseWeeks].map(element => element.innerText = ''); 
                        self.prtd_course_weeks.style.display = 'none';
                        [...self.HolderCourseWeeksVal].map(element => element.innerText = '');
                        // set insurace to off
                        self.FormInsurance.selectedIndex = 0;
                        [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                        self.prtd_insurance.style.display = 'none';
                        self.mySelections.courseWeeks = false; 
                        self.mySelections.Insurance = false; 
                        self.FormCourseNormalWeeks.value = '';
                        self.FormCourseSemesterWeeks.value = '';
                        self.FormCourseSemesterWeeks.disabled = true;
                        self.FormCourseNormalWeeks.disabled = true;
                        [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
                        self.prtd_course_summer_sup.style.display = 'none';
                        // SET SUM
                        self.subSum1T.summerFee = 0;
                        self.subSum1T.coursePrice = 0;
                        self.subSum3T.insurance = 0;
                    } 
                    if(self.mySelections.courseStart) {
                        self.mySelections.courseStart = false; 
                        self.FormCourseSemesterStart.value = '';
                        self.FormCourseNormalStart.value = '';
                        [...self.HolderCourseStartDate].map(element => element.innerText = ''); 
                        self.prtd_course_date.style.display = 'none';
                    } 

                    // discount
                    
                    console.log(response.data.course_info['registration_fee_off']);
                    if(response.data.course_info['registration_fee_off'] != '' ) {
                        self.mySelections.discount_registration_fee = true;
                        self.discountRegistrationFeeWaivedAfter  = parseInt(response.data.course_info['registration_fee_off'], 10);   
                        console.log(self.discountRegistrationFeeWaivedAfter);
                    }
                    if(response.data.course_info['accommodation_fee_off'] != '' ) {
                        self.mySelections.discount_accommodation_fee = true;
                        self.discountAccommoFeeWaivedAfter = parseInt(response.data.course_info['accommodation_fee_off'], 10); 
                    }
                    if(response.data.course_info['arrival_off'] != '' ) {
                        self.mySelections.discount_arrival = true;
                        self.discountArrivalWaivedAfter = parseInt(response.data.course_info['arrival_off'], 10); 
                    }
                    if(response.data.course_fixed_discounts['sum_course'] != 0 ) {
                        self.mySelections.discount_fixed = true;
                        self.sumOfFixed_discountCourse = parseInt(response.data.course_fixed_discounts['sum_course'], 10); 
                        self.sumOfFixed_discountTextCourse = response.data.course_fixed_discounts['text_course']
                    }
                    if(response.data.course_fixed_discounts['sum_accommo'] != 0 ) {
                        self.mySelections.discount_fixed = true;
                        self.sumOfFixed_discountAccommo = parseInt(response.data.course_fixed_discounts['sum_accommo'], 10); 
                        self.sumOfFixed_discountTextAccommo = response.data.course_fixed_discounts['text_accommo']
                    }
                    
                    self.pdf.course = {
                        id : sel.value,
                        name : sel.options[sel.selectedIndex].text,
                        start_date : "",
                        number_weeks : "",
                    };

                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.pdf.course = {
                    id : "",
                    name : "",
                    start_date : "",
                    number_weeks : "",
                };
                self.mySelections.course = false;
                self.mySelections.courseStart = false; 
                self.FormCourseSemesterStart.value = '';
                self.FormCourseNormalStart.value = '';
                self.FormCourseNormalStart.disabled = true;
                self.FormCourseSemesterStart.disabled = true;
                if(self.mySelections.courseWeeks) {
                    [...self.HolderCourseWeeks].map(element => element.innerText = ''); 
                    self.prtd_course_weeks.style.display = 'none';
                    [...self.HolderCourseStartDate].map(element => element.innerText = ''); 
                    self.prtd_course_date.style.display = 'none';
                    [...self.HolderCourseWeeksVal].map(element => element.innerText = '');
                    // set insurace to off
                    self.FormInsurance.selectedIndex = 0;
                    [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                    self.prtd_insurance.style.display = 'none';
                    self.mySelections.courseWeeks = false; 
                    self.mySelections.Insurance = false; 
                    self.FormCourseNormalWeeks.value = '';
                    self.FormCourseSemesterWeeks.value = '';
                    self.FormCourseSemesterWeeks.disabled = true;
                    self.FormCourseNormalWeeks.disabled = true;
                    [...self.HolderCourseSummerBlock].map(element => element.style.visibility = 'hidden'); 
                    self.prtd_course_summer_sup.style.display = 'none';
                    // SET SUM
                    self.subSum1T.summerFee = 0;
                    self.subSum1T.coursePrice = 0;
                    self.subSum3T.insurance = 0;
                }
                resolve();
            }
        })
    }

    courseAddonsOn(sel) { 
        
        return new Promise((resolve, reject) => {
            self.FormCourseAddonsWeeks.value = "";
            
            /*[...self.HolderCourseAddonsWeeks].map(element => {
                element.innerText = "";
                element.style.visibility = 'hidden';
            }); 
            [...self.HolderCourseAddonsPrice].map(element => {
                element.innerText = "";
                element.style.visibility = 'hidden';
            });*/
            
            self.subSum1T.courseAddonsPrice = 0;

            if(sel.value) {
                self.mySelections.course_addons = true;
                self.course_addons_id = sel.value;
                
                axios.get(base_url+'fees/fees_get_course_addons_info', { 
                    params: {
                        course_addons_id: sel.value,
                        region_id: self.regionId
                    }
                })
                .then(function (response) {
                    console.log(response);

                    self.FormCourseAddonsWeeks.disabled = false;
                    self.FormCourseAddonsStart.disabled = false;

                    [...self.HolderCourseAddonsName].map(element => {
                        element.innerText = sel.options[sel.selectedIndex].text;
                        element.style.visibility = 'visible';
                    }); 

                    self.prtd_course_addons.style.display = 'table-row';

                    self.pdf.addon = {
                        id : sel.value,
                        name : sel.options[sel.selectedIndex].text,
                        number_weeks : "",
                        price : "",
                        prices : "",
                        start_date : ""
                    };

                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.FormCourseAddonsWeeks.value = "";
                self.FormCourseAddonsWeeks.disabled = true;
                self.FormCourseAddonsWeeks.value = "";
                self.FormCourseAddonsStart.disabled = true;
                self.FormCourseAddonsStart.value = "";
                [...self.HolderCourseAddonsName].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_addons.style.display = 'none';
                self.mySelections.course_addons = false;

                self.pdf.addon = {
                    id : "",
                    name : "",
                    number_weeks : "",
                    price : "",
                    prices : "",
                    start_date : ""
                };

                resolve();
            }

        })
    }

    courseAddonsWeeksOn(sel) { 
        return new Promise((resolve, reject) => {
            console.log(" Course Addons Weeks On Action .. ");

            if(sel.value) {
                axios.get(base_url+'fees/fees_get_course_addons_weeks_info', { 
                    params: {
                        course_addons_id: self.course_addons_id,
                        weeks: sel.value
                    }
                })
                .then(function (response) {
                    self.courseAddonsPrice = response.data.prices;
                    self.subSum1T.courseAddonsPrice = response.data.prices;
                    
                    self.FormCourseAddonsWeeks.disabled = false;

                    [...self.HolderCourseAddonsWeeks].map(element => {
                        element.innerText = `${sel.options[sel.selectedIndex].text} (${response.data.price})`;
                        element.style.visibility = 'visible';
                    }); 
                    
                    [...self.HolderCourseAddonsPrice].map(element => {
                        element.innerText = response.data.prices;
                        element.style.visibility = 'visible';
                    }); 

                    self.prtd_course_addons.style.display = 'table-row';

                    self.pdf.addon = {
                        id : self.pdf.addon.id,
                        name : self.pdf.addon.name,
                        number_weeks : sel.options[sel.selectedIndex].text,
                        price : response.data.price,
                        prices : response.data.prices,
                        start_date : ""
                    };

                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                [...self.HolderCourseAddonsWeeks].map(element => {
                    element.innerText = "";
                    element.style.visibility = 'hidden';
                }); 
                [...self.HolderCourseAddonsPrice].map(element => {
                    element.innerText = "";
                    element.style.visibility = 'hidden';
                }); 
                self.prtd_course_addons.style.display = 'none';
                self.mySelections.course_addons = false;
                
                self.pdf.addon = {
                    id : self.pdf.addon.id,
                    name : self.pdf.addon.name,
                    number_weeks : "",
                    price : "",
                    prices : "",
                    start_date : "",
                };

                resolve();
            }

        })
    }

    courseAddonsStartOn(sel) {
        
        return new Promise((resolve, reject) => {
            console.log(" Course Addons Start On Action .. ");

            console.log("sel.value " + sel.value);

            if(sel.value) {

                [...self.HolderCourseAddonsWeeks].map(element => {
                    element.innerText = `${self.pdf.addon.number_weeks} (${self.pdf.addon.price}) (From : ${sel.value})`;
                    element.style.visibility = 'visible';
                }); 

                self.prtd_course_addons.style.display = 'table-row';

                self.pdf.addon = {
                    id : self.pdf.addon.id,
                    name : self.pdf.addon.name,
                    number_weeks : self.pdf.addon.number_weeks,
                    price : self.pdf.addon.price,
                    prices : self.pdf.addon.prices,
                    start_date : `${sel.value}`
                };
            } else {
                self.prtd_course_addons.style.display = 'none';
                self.mySelections.course_addons = false;
                
                self.pdf.addon = {
                    id : self.pdf.addon.id,
                    name : self.pdf.addon.name,
                    number_weeks : self.pdf.addon.number_weeks,
                    price : self.pdf.addon.price,
                    prices : self.pdf.addon.prices,
                    start_date : ""
                };
            }

            resolve();

        })
    }

    courseFamilyOn(sel) { 
        this.familyMaxWeeks(0);
        return new Promise((resolve, reject) => {
            self.subSum1T.courseFamilyPrice = 0;

            if(sel.value) {
                self.mySelections.course_family = true;
                self.course_family_id = sel.value;
                
                axios.get(base_url+'fees/fees_get_course_family_info', { 
                    params: {
                        course_family_id: sel.value,
                        region_id: self.regionId
                    }
                })
                .then(function (response) {
                    
                    self.subSum1T.courseFamilyPrice = 0;
                    self.FormCourseFamilyWeeks.disabled = false;

                    const weeks = self.calculateWeeks(response.data.dateto, response.data.datefrom);
                    
                    self.familyMaxWeeks(weeks);

                    [...self.HolderCourseFamilyName].map(element => {
                        element.innerHTML = '';
                    }); 
                    
                    [...self.HolderCourseFamilyPrice].map(element => {
                        element.innerHTML = '';
                    }); 

                    self.pdf.family = {
                        id : sel.value,
                        name : sel.options[sel.selectedIndex].text,
                        lessons : "",
                        start_date : "",
                        end_date : "",
                        price : "",
                        extra : "",
                        prices : "",
                        number_weeks : "",
                    },

                    self.prtd_course_family.style.display = 'table-row';
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.FormCourseFamilyWeeks.value = "";
                self.FormCourseFamilyWeeks.disabled = true;
                [...self.FormCourseFamilyWeeks].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_family.style.display = 'none';
                self.mySelections.course_family = false;

                self.pdf.family = {
                    id : "",
                    name : "",
                    lessons : "",
                    start_date : "",
                    end_date : "",
                    price : "",
                    extra : "",
                    prices : "",
                    number_weeks : "",
                },
                resolve();
            }

        })
    }

    courseFamilyWeeksOn(sel) { 
        return new Promise((resolve, reject) => {
            self.subSum1T.courseFamilyPrice = 0;

            if(sel.value) {
                
                axios.get(base_url+'fees/fees_get_course_family_info', { 
                    params: {
                        course_family_id: self.course_family_id,
                        region_id: self.regionId,
                        weeks: sel.value,
                    }
                })
                .then(function (response) {
                    
                    self.subSum1T.courseFamilyPrice = response.data.prices;
                    self.FormCourseFamilyWeeks.disabled = false;

                    [...self.HolderCourseFamilyName].map(element => {
                        element.innerHTML = '';
                        element.innerHTML += `${response.data.name} <br />`;
                        element.innerHTML += `${response.data.datefrom} To ${response.data.dateto} <br />`;
                        element.innerHTML += `${response.data.lessons} lessons (${response.data.price}) + extra (${response.data.extra})<br />`;
                        element.innerHTML += `${sel.options[sel.selectedIndex].text} <br />`;
                        element.style.visibility = 'visible';
                    }); 
                    
                    [...self.HolderCourseFamilyPrice].map(element => {
                        element.innerHTML = '';
                        element.innerHTML = `<br /><br /><br />${parseFloat(response.data.prices).toFixed(2)}<br />`;
                        element.style.visibility = 'visible';
                    }); 

                    self.pdf.family = {
                        id : self.pdf.family.id,
                        name : self.pdf.family.name,
                        lessons : response.data.lessons,
                        start_date : response.data.datefrom,
                        end_date : response.data.dateto,
                        price : response.data.price,
                        extra : response.data.extra,
                        prices : response.data.prices,
                        number_weeks : sel.options[sel.selectedIndex].text,
                    },

                    self.prtd_course_family.style.display = 'table-row';
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.FormCourseFamilyWeeks.value = "";
                self.FormCourseFamilyWeeks.disabled = true;
                [...self.FormCourseFamilyWeeks].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_family.style.display = 'none';

                self.pdf.family = {
                    id : self.pdf.family.id,
                    name : self.pdf.family.name,
                    lessons : "",
                    start_date : "",
                    end_date : "",
                    price : "",
                    extra : "",
                    prices : "",
                    number_weeks : "",
                },

                resolve();
            }

        })
    }

    courseExamOn(sel) { 
        return new Promise((resolve, reject) => {
            self.subSum1T.courseExamPrice = 0;

            if(sel.value) {
                self.mySelections.course_exam = true;
                self.course_exam_id = sel.value;
                
                axios.get(base_url+'fees/fees_get_course_exam_info', { 
                    params: {
                        course_exam_id: sel.value,
                        region_id: self.regionId
                    }
                })
                .then(function (response) {
                    
                    self.subSum1T.courseExamPrice = 0;
                    
                    self.FormCourseExamDates.innerHTML = response.data.courses_exam_dates;   
                    self.FormCourseExamDates.disabled = false;

                    self.FormCourseExamWeeks.innerHTML = response.data.courses_exam_weeks;   
                    self.FormCourseExamWeeks.disabled = false;

                    [...self.HolderCourseExamName].map(element => {
                        element.innerHTML = response.data.name;   ;
                        element.style.visibility = 'visible';
                    }); 

                    [...self.HolderCourseExamWeeks].map(element => {
                        element.innerHTML = ``;
                        element.style.visibility = 'visible';
                    }); 
                    
                    [...self.HolderCourseExamPrice].map(element => {
                        element.innerHTML = ``;
                        element.style.visibility = 'visible';
                    }); 

                    self.prtd_course_exam.style.display = 'table-row';

                    self.pdf.exam = {
                        id : sel.value,
                        name : sel.options[sel.selectedIndex].text,
                        lessons : "",
                        start_date : "",
                        price : "",
                        number_weeks : "",
                    }
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });

            } else {
                self.FormCourseExamDates.value = "";
                self.FormCourseExamDates.disabled = true;
                self.FormCourseExamWeeks.value = "";
                self.FormCourseExamWeeks.disabled = true;
                [...self.HolderCourseExamName].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_exam_name.style.display = 'none';
                self.mySelections.course_exam_name = false;

                
                self.pdf.exam = {
                    id : "",
                    name : "",
                    lessons : "",
                    start_date : "",
                    price : "",
                    number_weeks : "",
                }
                resolve();
            }

        })
    }

    courseExamWeeksOn(sel) { 
        
        return new Promise((resolve, reject) => {
            self.subSum1T.courseExamPrice = 0;

            if(sel.value) {
                self.mySelections.course_family = true;
                self.course_family_id = sel.value;
                
                axios.get(base_url+'fees/fees_get_course_exam_weeks_info', { 
                    params: {
                        course_exam_weeks_id: self.FormCourseExamWeeks.value,
                        region_id: self.regionId,
                        course_exam_id : self.course_exam_id
                    }
                })
                .then(function (response) {
                    
                    self.subSum1T.courseExamPrice = response.data.price;

                    self.FormCourseExam.disabled = false;

                    console.log("response", response);

                    [...self.HolderCourseExamName].map(element => {
                        element.innerHTML = `${response.data.name} <br />${response.data.notes}`;
                        element.style.visibility = 'visible';
                    }); 
                    
                    [...self.HolderCourseExamWeeks].map(element => {
                        element.innerHTML = `${response.data.lessons} lessons, ${response.data.duration} weeks, from ${self.FormCourseExamDates.value}`;
                        element.style.visibility = 'visible';
                    }); 
                    
                    [...self.HolderCourseExamPrice].map(element => {
                        element.innerHTML = `${parseFloat(response.data.price).toFixed(2)}`;
                        element.style.visibility = 'visible';
                    }); 
                        
                    self.pdf.exam = {
                        id : self.pdf.exam.id,
                        name : self.pdf.exam.name,
                        lessons : response.data.lessons,
                        start_date : self.FormCourseExamDates.value,
                        price : response.data.price,
                        number_weeks : response.data.duration,
                    }

                    self.prtd_course_family.style.display = 'table-row';
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
            } else {
                self.FormCourseExamWeeks.value = "";
                [...self.HolderCourseExamName].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderCourseExamWeeks].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderCourseFamilyPrice].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_family.style.display = 'none';
                self.mySelections.course_family = false;
                 
                self.pdf.exam = {
                    id : self.pdf.exam.id,
                    name : self.pdf.exam.name,
                    lessons : "",
                    start_date : "",
                    price : "",
                    number_weeks : "",
                }
                resolve();
            }
        })
    }
    
    courseProfessionalOn(sel) { 
        return new Promise((resolve, reject) => {
            self.subSum1T.courseProfessionalPrice = 0;

            if(sel.value) {
                self.mySelections.course_professional = true;
                self.course_professional_id = sel.value;
                
                axios.get(base_url+'fees/fees_get_course_professional_info', { 
                    params: {
                        course_professional_id: sel.value,
                        region_id: self.regionId
                    }
                })
                .then(function (response) {
                    
                    self.subSum1T.courseProfessionalPrice = response.data.price;
                    self.courseProfessionalWeeks = response.data.weeks;
                    
                    self.FormCourseProfessionalDates.innerHTML = response.data.courses_professional_dates;   
                    self.FormCourseProfessionalDates.disabled = false;

                    [...self.HolderCourseProfessionalName].map(element => {
                        element.innerHTML = `${response.data.name} <br /> ${response.data.notes}`;
                        element.style.visibility = 'visible';
                    }); 

                    [...self.HolderCourseProfessionalWeeks].map(element => {
                        element.innerHTML = `${response.data.weeks} weeks`;
                        element.style.visibility = 'visible';
                    }); 
                    
                    [...self.HolderCourseProfessionalPrice].map(element => {
                        element.innerHTML = response.data.price;
                        element.style.visibility = 'visible';
                    }); 

                    self.pdf.professional = {
                        id : sel.value,
                        name : response.data.name,
                        start_date : "",
                        price : response.data.price,
                        number_weeks : response.data.weeks,
                    }

                    self.prtd_course_professional.style.display = 'table-row';
                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });

            } else {
                self.courseProfessionalWeeks = '';
                self.FormCourseProfessional.value = "";
                self.FormCourseProfessionaDates.value = "";
                self.FormCourseProfessionaDates.disabled = true;
                [...self.HolderCourseProfessionaName].map(element => element.style.visibility = 'hidden'); 
                self.prtd_course_professional.style.display = 'none';

                self.pdf.professional = {
                    id : "",
                    name : "",
                    start_date : "",
                    price : "",
                    number_weeks : "",
                }

                resolve();
            }

        })
    }
    
    courseProfessionaDateslOn(sel) { 
        return new Promise((resolve, reject) => {
            [...self.HolderCourseProfessionalWeeks].map(element => {
                element.innerHTML = `${self.courseProfessionalWeeks} weeks`;
                if(sel.value){
                    element.innerHTML += ` from ${sel.value}`;
                    
                    self.pdf.professional = {
                        id : self.pdf.professional.id,
                        name : self.pdf.professional.name,
                        start_date : sel.value,
                        price : self.pdf.professional.price,
                        number_weeks : self.pdf.professional.number_weeks,
                    }
                }else{
                    self.pdf.professional = {
                        id : self.pdf.professional.id,
                        name : self.pdf.professional.name,
                        start_date : "",
                        price : self.pdf.professional.price,
                        number_weeks : self.pdf.professional.number_weeks,
                    }
                }
                
            }); 
        })
    }
    
    courseStartOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.pdf.course = {
                    id : self.pdf.course.id,
                    name : self.pdf.course.name,
                    start_date : sel.value,
                    number_weeks : self.pdf.course.number_weeks,
                    price : "",
                    prices : "",
                    insurance : "",
                    insurances : "",
                    summerFee : "",
                    waived : "",
                    discount_percent : "",
                    discount_amount : "",
                };
                self.mySelections.courseStart = true;
                self.courseStart = sel.value;
                [...self.HolderCourseStartDate].map(element => element.innerText = sel.value); 
                self.prtd_course_date.style.display = 'table-row';
                self.FormCourseSemesterWeeks.disabled = false;
                self.FormCourseNormalWeeks.disabled = false;
                if(self.mySelections.courseWeeks) {
                    [...self.HolderCourseStartDate].map(element => element.innerText = self.courseStart+' To '+self.formatDate(self.add_weeks(new Date(self.courseStart), self.courseWeeksNum))); 
                    // SET SUM
                    self.subSum1T.summerFee = self.calculCourseSummerFees();
                }
                resolve();
            } else {
                self.pdf.course = {
                    id : self.pdf.course.id,
                    name : self.pdf.course.name,
                    start_date : "",
                    number_weeks : "",
                    price : "",
                    prices : "",
                    insurance : "",
                    insurances : "",
                    summerFee : "",
                    waived : "",
                    discount_percent : "",
                    discount_amount : ""
                };
                self.mySelections.courseStart = false;
                self.mySelections.courseWeeks = false;
                self.FormCourseSemesterWeeks.disabled = true;
                self.FormCourseNormalWeeks.disabled = true;
                self.FormCourseSemesterWeeks.value = '';
                self.FormCourseNormalWeeks.value = '';
                resolve();
            }
        })
    }

    courseBirthdayHelperOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.courseStart = true;
                self.courseStart = sel.value;
                [...self.HolderCourseStartDate].map(element => element.innerText = sel.value); 
                self.prtd_course_date.style.display = 'table-row';
                self.FormCourseSemesterWeeks.disabled = false;
                self.FormCourseNormalWeeks.disabled = false;
                if(self.mySelections.courseWeeks) {
                    [...self.HolderCourseStartDate].map(element => element.innerText = self.courseStart+' To '+self.formatDate(self.add_weeks(new Date(self.courseStart), self.courseWeeksNum))); 
                    // SET SUM
                    self.subSum1T.summerFee = self.calculCourseSummerFees();
                }
                resolve();
            } else {
                self.mySelections.courseStart = false;
                self.mySelections.courseWeeks = false;
                self.FormCourseSemesterWeeks.disabled = true;
                self.FormCourseNormalWeeks.disabled = true;
                self.FormCourseSemesterWeeks.value = '';
                self.FormCourseNormalWeeks.value = '';
                resolve();
            }
        })
    }

    courseWeeksOn(sel) {
        
        /*[...self.HolderCourseAddonsWeeks].map(element => {
            element.style.visibility = 'hidden';
            element.innerText = "";
        }); 
        
        [...self.HolderCourseAddonsPrice].map(element => {
            element.style.visibility = 'hidden';
            element.innerText = "";
        }); */

        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.accommodationWeeks = false;
                self.course_waived  = 0;
                self.course_discount_percent  = 0;
                self.accommoMaxWeeks(parseInt(sel.value) + 2);
                //self.addonsMaxWeeks(parseInt(sel.value));
                self.mySelections.courseWeeks = true;
                self.courseWeeksNum = sel.value;
                axios.get(base_url+'fees/course_range_price', {
                    params: { 
                        weeks_num: sel.value,
                        course_id: self.courseId,
                        region_id: self.regionId
                    }
                })
                .then(function (response) {
                    //self.FormAccommodationWeeks.element.value = response.data.accommo_week_range;
                    
                    self.coursePrice = response.data.price;
                    self.course_waived  = response.data.course_waived;
                    self.course_discount_percent  = response.data.course_discount_percent;

                    /*if(self.FormCourseAddons.value){
                       self.FormCourseAddons.disabled = false;
                    }*/
                    
                    self.courseWeeksText = sel.options[sel.selectedIndex].text;
                    [...self.HolderCourseWeeks].map(element => element.innerText = sel.options[sel.selectedIndex].text); 
                    self.prtd_course_weeks.style.display = 'table-row';
                    [...self.HolderCourseStartDate].map(element => element.innerText = self.courseStart+' To '+self.formatDate(self.add_weeks(new Date(self.courseStart), sel.value))); 
                    self.prtd_course_date.style.display = 'table-row';
                    let courseP;
                    if (self.couseType ) { // ACADEMEC SEMESTER 
                        courseP = response.data.price;
                        [...self.HolderCourseWeeksVal].map(element => element.innerText = courseP); 
                        //[...self.HolderCourseWeeksVal].map(element => element.innerText = self.centreCurrencyName+' '+courseP); 
                    } else {
                        courseP = self.courseWeeksNum * response.data.price;
                        [...self.HolderCourseWeeksVal].map(element => element.innerText = courseP); 
                        //[...self.HolderCourseWeeksVal].map(element => element.innerText = self.centreCurrencyName+' '+ courseP); 
                    }
                    if(self.mySelections.Insurance) {
                        [...self.HolderInsuranceWeeks].map(element => element.innerText = self.courseWeeksText); 
                        [...self.HolderInsuranceVal].map(element => element.innerText = self.courseWeeksNum * self.centreInsurance);
                        //[...self.HolderInsuranceVal].map(element => element.innerText = self.centreCurrencyName+' '+self.courseWeeksNum * self.centreInsurance);
                        // SET SUM
                        self.subSum3T.insurance = parseInt(self.centreInsurance, 10)*parseInt(self.courseWeeksNum, 10);
                    }
                    // SET SUM
                    self.subSum1T.summerFee = self.calculCourseSummerFees();
                    self.subSum1T.coursePrice = courseP;

                    self.pdf.course = {
                        id : self.pdf.course.id,
                        name : self.pdf.course.name,
                        start_date : self.pdf.course.start_date,
                        end_date : self.formatDate(self.add_weeks(new Date(self.courseStart), sel.value)),
                        number_weeks : sel.value,
                        price : response.data.price,
                        prices : courseP,
                        insurance : self.centreInsurance,
                        insurances : self.subSum3T.insurance,
                        summerFee : self.subSum1T.summerFee,
                        waived : response.data.course_waived,
                        discount_percent : response.data.course_discount_percent,
                        discount_amount : 0,
                    };

                    resolve();
                })
                .catch(function (error) {
                    reject();
                });
            } else {
                self.pdf.course = {
                    id : self.pdf.course.id,
                    name : self.pdf.course.name,
                    start_date : self.pdf.course.start_date,
                    end_date : self.formatDate(self.add_weeks(new Date(self.courseStart), sel.value)),
                    number_weeks : "",
                    price : "",
                    prices : "",
                    insurance : "",
                    insurances : "",
                    summerFee : "",
                    waived : "",
                    discount_percent : "",
                    discount_amount : "",
                };
                self.mySelections.accommodationWeeks = false;
                self.course_waived  = 0;
                self.course_discount_percent  = 0;

                //self.FormCourseAddonsWeeks.disabled = true;
                //self.FormCourseAddonsWeeks.value = "";
                //this.addonsMaxWeeks(0);

                [...self.HolderCourseWeeks].map(element => element.innerText = ''); 
                self.prtd_course_weeks.style.display = 'none';
                
                //[...self.HolderCourseAddonsWeeks].map(element => element.innerText = ''); 
                //[...self.HolderCourseAddonsPrice].map(element => element.innerText = ''); 

                [...self.HolderCourseStartDate].map(element => element.innerText = self.courseStart); 
                self.prtd_course_date.style.display = 'table-row';
                [...self.HolderCourseWeeksVal].map(element => element.innerText = '');
                // set insurace to off
                self.FormInsurance.selectedIndex = 0;
                [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_insurance.style.display = 'none';
                self.mySelections.courseWeeks = false; 
                self.mySelections.Insurance = false; 
                // SET SUM
                self.subSum1T.summerFee = 0;
                self.subSum1T.coursePrice = 0;
                self.subSum3T.insurance = 0;
                resolve();
            }
        })
    }

    accommodationOn(sel) {
        return new Promise((resolve, reject) => {
            if(sel.value) {
                self.mySelections.accommodation = true;
                self.FormAccommodationWeeks.disabled = false;
                self.accommodationId = sel.value;   
                axios.get(base_url+'fees/fees_get_acco_info', {  
                    params: {
                        acco_id: sel.value
                    }
                })
                .then(function (response) {
                    [...self.HolderAccommodationName].map(element => element.innerText = sel.options[sel.selectedIndex].text); 
                    self.prtd_acco.style.display = 'table-row';
                    self.accommodationSummerFee = response.data.acco_info['a_summer_fees']; // * accomodationWeeks
                    self.accommodationSummerStart = response.data.acco_info['a_smr_s_dt_start'];
                    self.accommodationSummerEnds = response.data.acco_info['a_smr_s_dt_ends'];
                    self.accommodationSummerNote = response.data.acco_info['a_smr_s_note'];

                    self.accommodationGuardianshipOn = response.data.acco_info['guardianship_on'];
                    self.accommodationChristmasOn = response.data.acco_info['christmas_on'];

                    self.file_link.innerText = 'Document Details'; 
                    self.file_link.href = response.data.acco_info['file_link'];
                    self.file_link.style.visibility = 'visible'; 
                    
                    // SET SUM
                    if(self.mySelections.accommodationWeeks) {

                        axios.get(base_url+'fees/acco_range_price', {
                            params: {
                                weeks_num: self.accommodationWeeks,
                                acco_id: self.accommodationId,
                                accotype: self.couseType
                            }
                        })
                        .then(function (response2) {
                            self.accommodationPrice = response2.data.price; 
                            self.accommo_waived = response2.data.accommo_waived; 
                            self.accommo_discount_percent = response2.data.accommo_discount_percent; 
                            [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'visible'); 
                            self.prtd_acco_fees.style.display = 'table-row';
                            [...self.HolderAccommodationFeeVal].map(element => element.innerText = self.centreAccommodationFee); 
//                            [...self.HolderAccommodationFeeVal].map(element => element.innerText = self.centreCurrencyName+' '+self.centreAccommodationFee); 
                            const accoP = self.accommodationWeeks * response2.data.price; 
                            [...self.HolderAccommodationWeeksVal].map(element => element.innerText = accoP); 
//                            [...self.HolderAccommodationWeeksVal].map(element => element.innerText = self.centreCurrencyName+' '+ accoP); 
                            // SET SUM
                            self.subSum2T.accommodationFees = parseInt(self.centreAccommodationFee, 10);
                            self.subSum2T.accommodationSummerFees = self.calculAccommodationSummerFees();
                            self.subSum2T.accommodationPrice = parseInt(accoP, 10);

                            resolve();
                        })
                        .catch(function (error) {
                            reject(error);
                        });  
                    } else {
                        resolve();
                    }
                })
                .catch(function (error) {
                    reject(error);
                });

            } else {
                self.mySelections.accommodation = false;
                [...self.HolderAccommodationName].map(element => element.innerText = ''); 
                self.prtd_acco.style.display = 'none';
                self.mySelections.accommodationWeeks = false;
                self.FormAccommodationWeeks.disabled = true;
                self.FormAccommodationWeeks.value = ''; // value to 0
                [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_fees.style.display = 'none';
                [...self.HolderAccommodationWeeksVal].map(element => element.innerText = ''); 
                [...self.HolderAccommodationWeeks].map(element => element.innerText = ''); 
                [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_sup.style.display = 'none';

                self.accommodationGuardianshipOn = 0;
                self.accommodationChristmasOn = 0;

                self.file_link.innerText = ''; 
                self.file_link.href = '';
                self.file_link.style.visibility = 'hidden'; 

                // SET SUM
                self.subSum2T.accommodationFees = 0;
                self.subSum2T.accommodationSummerFees = 0;
                self.subSum2T.accommodationPrice = 0;
                resolve();
            }
        })
    }

    accommodationWeeksOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.accommodationWeeks = true;
                let coursewnww;
                if(self.mySelections.courseWeeks) {
                    coursewnww = self.courseWeeksNum;
                } else {
                    coursewnww = 'none';
                }

                axios.get(base_url+'fees/acco_range_price', {
                    params: {
                        weeks_num: sel.value,
                        acco_id: self.accommodationId,
                        accotype: self.couseType,
                        course_id: self.courseId,
                        course_weeks_num: coursewnww
                    }
                })
                .then(function (response) {
                    self.accommodationWeeks = sel.value;   
                    self.accommodationPrice = response.data.price; 
                    self.accommo_waived = response.data.accommo_waived; 
                    self.accommo_discount_percent = response.data.accommo_discount_percent; 

                    console.log("..............................");
                    
                    self.accommodation.start_date = self.courseStart;
                    self.accommodation.end_date = self.formatDate(self.add_weeks(new Date(self.courseStart), sel.value))
                    self.accommodation.discount = response.data.accommodation_discount * response.data.promo_price / 100;
                    self.accommodation.percent = response.data.accommodation_percent;
                    self.accommodation.weeks = response.data.accommodation_weeks;
                    self.accommodation.price = response.data.accommodation_price;
                    self.accommodation.prices = response.data.accommodation_prices;

                    self.promo.price = response.data.promo_price;
                    self.promo.prices = response.data.promo_prices;
                    self.promo.christmas = response.data.promo_christmas;
                    self.promo.min_weeks = response.data.promo_weeks;
                    self.promo.combinable = response.data.promo_combinable;

                    self.promo.start_date = response.data.promo_start;
                    self.promo.end_date = response.data.promo_end;
                    self.promo.before_date = response.data.promo_before;

                    const promoPrice = self.calculatePromoPrice(self.accommodation, self.promo);

                    console.log("..............................");
                    if(promoPrice > 0){
                        [...self.HolderDscAccommoFeePromo].map(element => element.style.visibility = 'visible'); 
                        [...self.HolderDscAccommoFeePromoText].map(element => element.innerText = `-${promoPrice} ${self.centreCurrencyName} off accommodation offer`); 
                        [...self.HolderDscAccommoFeePromoValue].map(element => element.innerText = `${promoPrice}`); 
                    }else{
                        [...self.HolderDscAccommoFeePromo].map(element => element.style.visibility = 'hidden');
                        [...self.HolderDscAccommoFeePromoText].map(element => element.innerText = '');
                        [...self.HolderDscAccommoFeePromoValue].map(element => element.innerText = '');
                    }

                    console.log("..............................");

                    [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'visible'); 
                    self.prtd_acco_fees.style.display = 'table-row';
                    [...self.HolderAccommodationFeeVal].map(element => element.innerText = self.centreAccommodationFee); 
                    
                    const accoP = sel.value * response.data.price; 
                    [...self.HolderAccommodationWeeksVal].map(element => element.innerText = accoP);
                    [...self.HolderAccommodationWeeks].map(element => element.innerText = sel.options[sel.selectedIndex].text); 
                    
                    // SET SUM
                    self.subSum2T.accommodationFees = parseInt(self.centreAccommodationFee, 10);
                    self.subSum2T.accommodationSummerFees = self.calculAccommodationSummerFees();
                    self.subSum2T.accommodationPrice = parseInt(accoP, 10);
                    self.subSum2T.accommodationPromo = (-1) * promoPrice;

                    let total = parseFloat(self.subSum2T.accommodationPrice) - parseFloat(self.accommoDiscount());

                    self.pdf.accommodation = {
                        start_date: self.accommodation.start_date,
                        end_date: self.accommodation.end_date,
                        discount: self.accommoDiscount(),
                        percent: self.accommodation.percent,
                        weeks: self.accommodation.weeks,
                        price: self.accommodation.price,
                        prices: accoP,
                        total : total,
                        fees : self.subSum2T.accommodationFees,
                        summer_fees : self.subSum2T.accommodationFees,
                        summer_fees : self.subSum2T.accommodationFees,
                    }
                    self.pdf.promo = {
                        start_date: self.promo.start_date,
                        end_date: self.promo.end_date,
                        before_date: self.promo.before_date,
                        price: self.promo.price,
                        christmas: self.promo.christmas,
                        min_weeks: self.promo.min_weeks,
                        combinable: self.promo.combinable,
                        prices: promoPrice
                    }

                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });            
                
            } else {
                self.accommo_waived = 0; 
                self.accommo_discount_percent = 0; 

                self.mySelections.accommodationWeeks = false;
                [...self.HolderAccommodationFeeRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_fees.style.display = 'none';
                [...self.HolderAccommodationWeeksVal].map(element => element.innerText = ''); 
                [...self.HolderAccommodationWeeks].map(element => element.innerText = ''); 
                [...self.HolderAccoSummerBlock].map(element => element.style.visibility = 'hidden'); 
                self.prtd_acco_sup.style.display = 'none';

                
                [...self.HolderDscAccommoFeePromo].map(element => element.style.visibility = 'hidden'); 
                [...self.HolderDscAccommoFeePromoText].map(element => element.innerText = ""); 
                [...self.HolderDscAccommoFeePromoValue].map(element => element.innerText = ""); 

                // SET SUM
                self.subSum2T.accommodationFees = 0;
                self.subSum2T.accommodationSummerFees = 0;
                self.subSum2T.accommodationPrice = 0;

                self.pdf.accommodation = {
                    start_date: "",
                    end_date: "",
                    discount: "",
                    percent: "",
                    weeks: "",
                    price: "",
                    prices: "",
                    total : "",
                    fees : "",
                    summer_fees : "",
                    summer_fees : "",
                }
                self.pdf.promo = {
                    start_date: "",
                    end_date: "",
                    before_date: "",
                    price: "",
                    prices: "",
                    christmas: "",
                    min_weeks: "",
                    combinable: "",
                    promoPrice: ""
                }
                
                resolve();
            }
        })
    }

    courierOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.courierFee = true;
                [...self.HolderAramexRow].map(element => element.style.visibility = 'visible'); 
                self.prtd_aramex.style.display = 'table-row';
                [...self.HolderAramexVal].map(element => element.innerText = self.centreCourierFee); 
//                [...self.HolderAramexVal].map(element => element.innerText = self.centreCurrencyName+' '+self.centreCourierFee); 
                // SET SUM
                self.subSum3T.courierFee = parseInt(self.centreCourierFee, 10);

                self.pdf.others.courier =  self.centreCourierFee;

                resolve();
            } else {
                self.mySelections.courierFee = false;
                [...self.HolderAramexRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_aramex.style.display = 'none';
                // SET SUM
                self.subSum3T.courierFee = 0;
                
                self.pdf.others.courier =  "";
                resolve();
            }
        })
    }

    insuranceOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.Insurance = true; 
                [...self.HolderInsuranceWeeks].map(element => element.innerText = self.courseWeeksText); 
                [...self.HolderInsuranceVal].map(element => element.innerText = self.courseWeeksNum * self.centreInsurance);
//                [...self.HolderInsuranceVal].map(element => element.innerText = self.centreCurrencyName+' '+self.courseWeeksNum * self.centreInsurance);
                [...self.HolderInsuranceRow].map(element => element.style.visibility = 'visible'); 
                self.prtd_insurance.style.display = 'table-row';
                // SET SUM
                self.subSum3T.insurance = parseInt(self.centreInsurance, 10)*parseInt(self.courseWeeksNum, 10);
                self.pdf.insurance.weeks = self.courseWeeksNum;
                self.pdf.insurance.price = self.centreInsurance;
                self.pdf.insurance.prices = self.subSum3T.insurance;
                resolve();
            } else {
                self.mySelections.Insurance = false;
                [...self.HolderInsuranceRow].map(element => element.style.visibility = 'hidden'); 
                self.prtd_insurance.style.display = 'none';
                // SET SUM
                self.subSum3T.insurance = 0; 
                self.pdf.insurance.weeks = "";
                self.pdf.insurance.price = "";
                self.pdf.insurance.prices = "";
                resolve();
            }
        })
    }

    arrivalOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.arrival = true;
                axios.get(base_url+'fees/fees_get_airp_info', {
                    params: {
                        airp_id: sel.value
                    }
                })
                .then(function (response) {
                    self.centreAirportArrivalPrice = response.data.airp_info['arrival_price']; 
                    [...self.HolderAirportRow].map(element => element.style.visibility = 'visible'); 
                    self.prtd_airport.style.display = 'table-row';
                    [...self.HolderArrivalName].map(element => element.innerText = 'Arrival : '+sel.options[sel.selectedIndex].text); 
                    [...self.HolderArrivalVal].map(element => element.innerText = self.centreAirportArrivalPrice ); 
//                    [...self.HolderArrivalVal].map(element => element.innerText = self.centreCurrencyName+' '+self.centreAirportArrivalPrice ); 
                    if(!self.mySelections.departure) {
                        [...self.HolderDepartureName].map(element => element.innerText = 'Departure : Not Required'); 
                    } 
                    // SET SUM
                    self.subSum3T.arrival = parseInt(self.centreAirportArrivalPrice, 10);
                    
                    self.pdf.airport.arrival_name = sel.options[sel.selectedIndex].text;
                    self.pdf.airport.arrival_price = self.centreAirportArrivalPrice;

                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
                
            } else {
                self.mySelections.arrival = false;
                if(self.mySelections.departure) {
                    [...self.HolderArrivalName].map(element => element.innerText = 'Arrival : Not Required'); 
                    [...self.HolderArrivalVal].map(element => element.innerText = ''); 
                }  else {
                    [...self.HolderAirportRow].map(element => element.style.visibility = 'hidden'); 
                    self.prtd_airport.style.display = 'none';
                }
                // SET SUM
                self.subSum3T.arrival = 0;
                
                self.pdf.airport.arrival_name = "";
                self.pdf.airport.arrival_price = "";
                resolve();
            }
        })
    }

    departureOn(sel) {
        return new Promise((resolve, reject) => {
            if (sel.value) {
                self.mySelections.departure = true;
                axios.get(base_url+'fees/fees_get_airp_info', {
                    params: {
                        airp_id: sel.value
                    }
                })
                .then(function (response) {
                    self.centreAirportDeparturePrice = response.data.airp_info['departure_price']; 

                    [...self.HolderAirportRow].map(element => element.style.visibility = 'visible'); 
                    self.prtd_airport.style.display = 'table-row';
                    if(!self.mySelections.arrival) {
                        [...self.HolderArrivalName].map(element => element.innerText = 'Arrival : Not Required'); 
                    }  
                    [...self.HolderDepartureName].map(element => element.innerText = 'Departure : '+sel.options[sel.selectedIndex].text); 
                    [...self.HolderDepartureVal].map(element => element.innerText = self.centreAirportDeparturePrice); 
//                    [...self.HolderDepartureVal].map(element => element.innerText = self.centreCurrencyName+' '+self.centreAirportDeparturePrice); 
                    // SET SUM
                    self.subSum3T.departure = parseInt(self.centreAirportDeparturePrice, 10);
                        
                    self.pdf.airport.departure_name = sel.options[sel.selectedIndex].text;
                    self.pdf.airport.departure_price = self.centreAirportDeparturePrice;

                    resolve();
                })
                .catch(function (error) {
                    reject(error);
                });
                
            } else {
                self.mySelections.departure = false;
                if(self.mySelections.arrival) {
                    [...self.HolderDepartureName].map(element => element.innerText = 'Departure : Not Required'); 
                    [...self.HolderDepartureVal].map(element => element.innerText = ''); 
                }  else {
                    [...self.HolderAirportRow].map(element => element.style.visibility = 'hidden'); 
                    self.prtd_airport.style.display = 'none';
                }
                // SET SUM
                self.subSum3T.departure = 0;
                
                self.pdf.airport.departure_name = "";
                self.pdf.airport.departure_price = "";
                resolve();
            }
        })
    }

    pdfquoteOn(sel) {
        return new Promise((resolve, reject) => {
            console.log("pdf quote .. ")
            resolve();
        })
    }

    printquoteOn(sel) {
        return new Promise((resolve, reject) => {
            console.log("print quote .. ")
            resolve();
        })
    }

}

class Calcul extends MyForm {
    
    constructor() {
        super();
    }
    
    getSum(erobj) {
        let sum = 0;
        for (let key in erobj) {
            console.log(key + " : " + erobj[key]);
            if(erobj[key]){
                sum += parseFloat(erobj[key]);
            }
        }
        console.log("sum ", sum);
        return sum;
    }

    guardianshipWeeksNum() {



        let now = moment(self.courseStart); 
        let end = moment(self.birthdayHelperDate); 
        let duration = moment.duration(now.diff(end));
        
        let weeksDiffDays = duration.asDays();
        
        if(weeksDiffDays > 6574) {
            return 0;
        }else {
            let needtb18 = 6573 - weeksDiffDays;
            let accommoDays = self.accommodationWeeks *7;
            let x =  accommoDays - needtb18;

            if(x <= 0 ) {
                return self.accommodationWeeks;
            } 
            else {
                return Math.ceil(needtb18/7);
            }
        }
        
    }

    guardianshipSum() {
        if( self.accommodationGuardianshipOn == 0 ) return 0;
        let guardSum = self.centreGuardianshipFee  * this.guardianshipWeeksNum(); 
        //console.log('final guardianshipSum : '+guardSum);
        return guardSum.toFixed(2);
    }

    calculat_guardianship() {
        let sum = 0;
        if(self.mySelections.accommodationWeeks && self.mySelections.courseStart) {
            sum = this.guardianshipSum();
            if(sum > 0) {
                [...self.Holdercal_acco_guardianship_fee_price].map(element => element.innerText = sum); 
                self.HolderGuardianshipFeeRow.style.visibility = 'visible'; 
                self.HolderGuardianshipFeeRowPdf.style.display = 'table-row';
            } else {
                self.HolderGuardianshipFeeRow.style.visibility = 'hidden'; 
                self.HolderGuardianshipFeeRowPdf.style.display = 'none';
            }
        } else {
            self.HolderGuardianshipFeeRow.style.visibility = 'hidden'; 
            self.HolderGuardianshipFeeRowPdf.style.display = 'none';
        }
        return sum;
    }

    christmasSum() {

        if(self.accommodationChristmasOn == 0 ) return 0;
        const accommoEndDate = moment(self.courseStart, 'YYYY-MM-DD').add(self.accommodationWeeks, 'w').format('YYYY-MM-DD');
        //console.log('courseStart : '+self.courseStart);
        //console.log('courseEndDate : '+courseEndDate);
        //console.log('centreChristmasStart : '+self.centreChristmasStart);
        //console.log('centrechristmas_end : '+self.centrechristmas_end);
        const dates = [
            [self.courseStart,accommoEndDate],
            [self.centreChristmasStart,self.centrechristmas_end]
        ];
        const weeksIntersect = Math.round(self.rangeToWeeks(self.intersectDateRanges(dates)));

        //console.log('self.rangeToWeeks(self.intersectDateRanges(dates)) : '+self.rangeToWeeks(self.intersectDateRanges(dates)));
        //console.log('weeksIntersect ceil : '+ Math.round(self.rangeToWeeks(self.intersectDateRanges(dates))));
        //console.log('weeksIntersect round: '+weeksIntersect);

        if (!isNaN(weeksIntersect)) {
            if( weeksIntersect != 0) {
                //console.log('weeksIntersect != 0, centreChristmasFee : '+self.centreChristmasFee);
                return self.centreChristmasFee * weeksIntersect;
            } else {
                //console.log('weeksIntersect != 0 else : return 0');
                return 0;
            }
        } else {
            //console.log('!isNaN(weeksIntersect) else : return 0');
            return 0;
        }
    }
    calculat_christmas() {
        let sum = 0;
        if(self.mySelections.accommodationWeeks && self.mySelections.courseStart) {
            sum = this.christmasSum();
            if(sum > 0) {
                [...self.Holdercal_cal_acco_christmas_price].map(element => element.innerText = sum); 
                self.HolderChristmasRow.style.visibility = 'visible'; 
                self.HolderChristmasRowPdf.style.display = 'table-row';
            } else {
                self.HolderChristmasRow.style.visibility = 'hidden'; 
                self.HolderChristmasRowPdf.style.display = 'none';
            }
        } else {
            self.HolderChristmasRow.style.visibility = 'hidden'; 
            self.HolderChristmasRowPdf.style.display = 'none';
        }
        return sum;
    }
    booksFeeSum() {
        let booksfee = self.centreBooksFee;
        if(self.centreBooksWeeks == 0) booksfee = self.centreBooksFee;
        else {
            var x = self.courseWeeksNum / self.centreBooksWeeks;
            booksfee = Math.ceil(x)*self.centreBooksFee;
            //console.log('x = '+x);
            //console.log('x ceil = '+Math.ceil(x));
        }
        return parseInt(booksfee, 10);
    }

    accommoDiscount() {
        let DiscountSum2T = 0;
        if(self.mySelections.accommodationWeeks) {
            if(self.accommo_waived != 0) {
                DiscountSum2T = self.accommo_waived * self.accommodationWeeks;
                console.log(`XX ${self.accommo_waived} ${self.accommodationWeeks}`);
                [...self.HolderDscAccommoText].map(element => element.innerText = self.accommo_discount_percent+'% off accommodation Discount');
                [...self.HolderDscAccommoAmount].map(element => element.innerText = '- '+DiscountSum2T); 
                [...self.HolderDscAccommo].map(element => element.style.visibility = 'visible'); 
            } else {
                [...self.HolderDscAccommo].map(element => element.style.visibility = 'hidden'); 
            }
        } else {
            [...self.HolderDscAccommo].map(element => element.style.visibility = 'hidden'); 
        }
        return DiscountSum2T;
    }

    studentIsOver18() {
        let now = moment(self.courseStart); //todays date
        let end = moment(self.birthdayHelperDate); // another date
        let duration = moment.duration(now.diff(end));
        //6574  days in 18 years
        let daysDiffDays = duration.asDays();
        
        if(daysDiffDays > 6574) return true;
        else return false;
    }

    custodianshipSum() {
        if(self.countryName != 'Canada') return 0;
        if(this.studentIsOver18()) return 0;
        return self.centreCustodianshipFee;
    }

    calculat_custodianship() {
        let sum = 0;
        if(self.mySelections.courseStart) {
            sum = this.custodianshipSum();
            if(sum > 0) {
                [...self.Holdercal_custodianship_fee_price].map(element => element.innerText = sum); 
                self.HolderCustodianshipFeeRow.style.visibility = 'visible'; 
                self.HolderCustodianshipFeeRowPdf.style.display = 'table-row';
            } else {
                self.HolderCustodianshipFeeRow.style.visibility = 'hidden'; 
                self.HolderCustodianshipFeeRowPdf.style.display = 'none';
            }
        } else {
            self.HolderCustodianshipFeeRow.style.visibility = 'hidden'; 
            self.HolderCustodianshipFeeRowPdf.style.display = 'none';
        }
        return sum;
    }

    calculate() {
        let subTotal, DiscountSum1T, DiscountSum2T, DiscountSum3T, DiscountSum4T;
        subTotal = DiscountSum1T = DiscountSum2T = DiscountSum3T = DiscountSum4T = 0;

        //calculate age
        console.log("Calculate .. ");
        console.log("Course Start  : " + self.courseStart + ", Birthday Date : " + self.birthdayHelperDate);

        let today = new Date();
        let startDate = new Date(self.courseStart);
        let birthDate = new Date(self.birthdayHelperDate);

        let ageMilliseconds = startDate - birthDate;

        let ageYears = Math.floor(ageMilliseconds / (1000 * 60 * 60 * 24 * 7 * 52));
        let ageWeeks = Math.floor(ageMilliseconds / (1000 * 60 * 60 * 24 * 7));

        let baseWeeks = 18 * 52 - ageWeeks;

        if(baseWeeks < 0){
            self.FormStudentAge.value = `${ageYears} years`;
        }else{
            if(baseWeeks){
                self.FormStudentAge.value = `18 years -${baseWeeks} weeks`;
            }else{
                self.FormStudentAge.value = ` laoding .. `;
            }
        }

        //
        if(self.mySelections.courseWeeks) {
            // course discount
            if(self.course_waived != 0) {
                //self.subSum1T.coursePrice = self.subSum1T.coursePrice - self.course_waived; 
                DiscountSum1T = self.course_waived * self.courseWeeksNum;
                [...self.HolderDscCourseText].map(element => element.innerText = self.course_discount_percent+'% off tuition prices'); 
                [...self.HolderDscCourseAmount].map(element => element.innerText = ('- ' + self.course_waived * self.courseWeeksNum)); 
                [...self.HolderDscCourse].map(element => element.style.visibility = 'visible'); 

                self.pdf.course.discount_amount = (self.course_waived * self.courseWeeksNum);
            } else {
                [...self.HolderDscCourse].map(element => element.style.visibility = 'hidden'); 
                self.pdf.course.discount_amount = "";
            }

            // if(self.mySelections.accommodationWeeks) {
            //     if(self.accommo_waived != 0) {
            //         DiscountSum2T = self.accommo_waived * self.accommodationWeeks;
            //         [...self.HolderDscAccommoText].map(element => element.innerText = self.accommo_discount_percent+'% off accommodation Discount');
            //         [...self.HolderDscAccommoAmount].map(element => element.innerText = '- '+self.accommo_waived * self.accommodationWeeks); 
            //         [...self.HolderDscAccommo].map(element => element.style.visibility = 'visible'); 
            //     } else {
            //         [...self.HolderDscAccommo].map(element => element.style.visibility = 'hidden'); 
            //     }
            // } else {
            //     [...self.HolderDscAccommo].map(element => element.style.visibility = 'hidden'); 
            // }

            if(self.mySelections.discount_registration_fee ) {
                if(self.courseWeeksNum > self.discountRegistrationFeeWaivedAfter) {
                    //self.subSum1T.registrationFees = 0; 
                    DiscountSum1T = DiscountSum1T + self.subSum1T.registrationFees;
                    //[...self.HolderDscRegistrationFee].map(element => element.innerText = 'Registration fee waived');
                    [...self.HolderDscRegistrationFee].map(element => element.style.visibility = 'visible'); 
                } else {
                    [...self.HolderDscRegistrationFee].map(element => element.style.visibility = 'hidden'); 
                }
            } else {
                [...self.HolderDscRegistrationFee].map(element => element.style.visibility = 'hidden'); 
            }
            if(self.mySelections.discount_accommodation_fee && self.mySelections.accommodationWeeks ) {
                if(self.courseWeeksNum > self.discountAccommoFeeWaivedAfter) {
                    //self.subSum2T.accommodationFees = 0; 
                    DiscountSum2T = DiscountSum2T + self.subSum2T.accommodationFees;
                    //[...self.HolderDscAccommoFee].map(element => element.innerText = 'Accommodation Placement fee waived');
                    [...self.HolderDscAccommoFee].map(element => element.style.visibility = 'visible');
                } else {
                    [...self.HolderDscAccommoFee].map(element => element.style.visibility = 'hidden'); 
                }
            } else {
                [...self.HolderDscAccommoFee].map(element => element.style.visibility = 'hidden'); 
            }
            if(self.mySelections.discount_arrival && self.mySelections.arrival) {
                if(self.courseWeeksNum > self.discountArrivalWaivedAfter) {
                    //self.subSum3T.arrival = 0; 
                    DiscountSum3T = self.subSum3T.arrival;
                    //[...self.HolderDscArrival].map(element => element.innerText = 'Free Arrival Transfer');
                    [...self.HolderDscArrival].map(element => element.style.visibility = 'visible');
                } else {
                    [...self.HolderDscArrival].map(element => element.style.visibility = 'hidden'); 
                }
            } else {
                [...self.HolderDscArrival].map(element => element.style.visibility = 'hidden'); 
            }
        } else {
            [...self.HolderDscCourse].map(element => element.style.visibility = 'hidden'); 
            [...self.HolderDscArrival].map(element => element.style.visibility = 'hidden'); 
            [...self.HolderDscAccommoFee].map(element => element.style.visibility = 'hidden'); 
            [...self.HolderDscRegistrationFee].map(element => element.style.visibility = 'hidden'); 
            [...self.HolderDscAccommo].map(element => element.style.visibility = 'hidden'); 
        }

        //
        if(self.mySelections.discount_fixed) {
            //subTotal = subTotal - self.sumOfFixed_discountAccommo - self.sumOfFixed_discountCourse; // fixed_discount 
            if( self.sumOfFixed_discountTextCourse != '' ) {
                // show text in Course Section self.sumOfFixed_discountTextCourse
                DiscountSum1T = DiscountSum1T + self.sumOfFixed_discountCourse;
                [...self.HolderDscCourseFixedText].map(element => element.innerText = self.sumOfFixed_discountTextCourse);
                [...self.HolderDscCourseFixedAmount].map(element => element.innerText = '- '+self.sumOfFixed_discountCourse);
                [...self.HolderDscCourseFixed].map(element => element.style.visibility = 'visible');
            } else {
                [...self.HolderDscCourseFixed].map(element => element.style.visibility = 'hidden');
            }
            if( self.sumOfFixed_discountTextAccommo != '' ) {
                // show text in Course Section self.sumOfFixed_discountTextAccommo
                DiscountSum2T = DiscountSum2T + self.sumOfFixed_discountAccommo;
                [...self.HolderDscAccommoFixedText].map(element => element.innerText = self.sumOfFixed_discountTextAccommo);
                [...self.HolderDscAccommoFixedAmount].map(element => element.innerText = '- '+self.sumOfFixed_discountAccommo);
                [...self.HolderDscAccommoFixed].map(element => element.style.visibility = 'visible');
            } else {
                [...self.HolderDscAccommoFixed].map(element => element.style.visibility = 'hidden'); 
            }
        } else {
            // remove text from both Course section and from Accommo section
            [...self.HolderDscCourseFixed].map(element => element.style.visibility = 'hidden'); 
            [...self.HolderDscAccommoFixed].map(element => element.style.visibility = 'hidden'); 
        }


        DiscountSum2T = self.accommoDiscount();

        let guardAndChrisSum = parseFloat(this.calculat_guardianship()) + parseFloat(this.calculat_christmas()); 

        let custodianshipTotal = this.calculat_custodianship();

 
        let booksFeePrice = self.booksFeeSum();
        [...self.HolderBooksVal].map(element => element.innerText = booksFeePrice); 


        let subSum1 = this.getSum(self.subSum1T) - DiscountSum1T; 
        let subSum2 = this.getSum(self.subSum2T) + guardAndChrisSum + custodianshipTotal - DiscountSum2T;
        let subSum3 = this.getSum(self.subSum3T) - DiscountSum3T + booksFeePrice; 

        subTotal = subSum1 + subSum2 + subSum3; 
        let subTotalSar = subTotal * self.centreCurrencyPrice; 
        
        subSum1 = subSum1.toFixed(2);
        subSum2 = subSum2.toFixed(2);
        subSum3 = subSum3.toFixed(2);

        subTotal = subTotal.toFixed(2);
        subTotalSar = subTotalSar.toFixed(2);

        console.log("Subsum Total 1 : " + subSum1);

        [...self.HolderSub1Val].map(element => element.innerText = self.centreCurrencyName + ' ' + subSum1); 
        [...self.HolderSub2Val].map(element => element.innerText = self.centreCurrencyName + ' ' + subSum2); 
        [...self.HolderSub3Val].map(element => element.innerText = self.centreCurrencyName + ' ' + subSum3); 

        [...self.HolderTotal].map(element => element.innerText = self.centreCurrencyName + ' ' + subTotal); 

        [...self.HolderTotalSAR].map(element => element.innerText = subTotalSar); 

        
        self.pdf.totals = {
            subTotal: subTotal,
            subTotalSar: subTotalSar,
            subSum1: subSum1,
            subSum2: subSum2,
            subSum3: subSum3,
            guardAndChrisSum: guardAndChrisSum,
            custodianshipTotal: custodianshipTotal,
            booksFeePrice: booksFeePrice
        }

    }

}

const calcul = new Calcul();

function region_onchange(sel) {
    calcul.regionOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function birthday_helper_onchange(sel) {
    console.log("birthday_helper_onchange .. ");
    calcul.birthdayHelperOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function country_onchange(sel) {
    calcul.countryOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function city_onchange(sel) {
    calcul.cityOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function centre_onchange(sel) { 
    calcul.centreOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_onchange(sel) {
    calcul.courseOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_addons_onchange(sel) {
    calcul.courseAddonsOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_addons_weeks_onchange(sel) {
    calcul.courseAddonsWeeksOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_family_onchange(sel) {
    calcul.courseFamilyOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_family_weeks_onchange(sel) {
    calcul.courseFamilyWeeksOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_exam_onchange(sel) {
    calcul.courseExamOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_exam_weeks_onchange(sel) {
    calcul.courseExamWeeksOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_professional_onchange(sel) {
    calcul.courseProfessionalOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}

function course_professional_dates_onchange(sel) {
    calcul.courseProfessionaDateslOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_start_onchange(sel) {
    console.log("course_start_onchange .. ");
    calcul.courseStartOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function course_addons_start_onchange(sel) {
    console.log("course_addons_start_onchange .. ");
    calcul.courseAddonsStartOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}

function course_weeks_onchange(sel) {
    calcul.courseWeeksOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function accommodation_onchange(sel) {
    calcul.accommodationOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function accommodation_weeks_onchange(sel) {
    calcul.accommodationWeeksOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function aramex_onchange(sel) {
    calcul.courierOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function insurance_onchange(sel) {
    calcul.insuranceOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function airport_arr_onchange(sel) {
    calcul.arrivalOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}
function airport_dep_onchange(sel) {
    calcul.departureOn(sel)
    .then( () => calcul.calculate() )
    .catch(function (error) {
        console.log(error);
    });
}

function options_onchange(current, option, title) {

    const target_option = document.getElementById(option);
    const target_title = document.getElementById(title);

    if (current.checked) {
        target_option.classList.remove('off');
        target_title.classList.remove('off');
    } else {
        target_option.classList.add('off');
        target_title.classList.add('off');
    }

}

const next_page = document.getElementById("next_page");
const prev_page = document.getElementById("prev_page");
const course_input = document.getElementById("course_input");
const client_input = document.getElementById("client_input");
const first_button1 = document.getElementById("first_button1");
const second_button1 = document.getElementById("second_button1");

next_page.addEventListener('click', function(event){
    event.preventDefault();
    course_input.style.display = "none";
    client_input.style.display = "block";
    first_button1.style.display = "none";
    second_button1.style.display = "block";
});

prev_page.addEventListener('click', function(event){
    event.preventDefault();
    client_input.style.display = "none";
    course_input.style.display = "block";
    second_button1.style.display = "none";
    first_button1.style.display = "block";
});
